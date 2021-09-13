<?php
namespace App\Libs;

/**
 * @Annotation 
 * Route URI to specific link in according with HTTP method 
 */
class Route
{
  public $uri;
  public $method;
  public $request;
  public $controller;
  public $function;

  /**
   * @param string $method The HTTP request method
   * @param string $request The request URI to specify
   * @param string $controller The Controller Class use for function and render 
   * @param string $function The Method inside Controller Class for process 
   */
  function __construct($method, $request, $controller, $function)
  {
    $this->uri = $_SERVER['REQUEST_URI'];
    $this->method = $method;
    $this->request = $request;
    $this->controller = $controller;
    $this->function = $function;
    $this->_route();
  }

  private function _parse_uri($uri)
  {
    if (strpos($uri, '?') !== false) {
      $req = explode('/', trim(substr($uri, 0, strpos($uri, '?')), '/'));
    } else {
      $req = explode('/', trim($uri, '/'));
    }
    return $req;
  }

  private function _set_param()
  {
    $request = $this->_parse_uri($this->uri);
    $target = $this->_parse_uri($this->request);

    #- Bypass this first
    if ($this->method === $_SERVER['REQUEST_METHOD']) {
      if ($request === $target)
        return true;
      if (count($target) === count($request)) {
        $ck = 0;
        $num = count($request);
        for ($n = 0; $n < $num; $n++) {
          if ($request[$n] === $target[$n]) {
            $ck++;
            if ($ck === $num)
              return true;
          } else if ($ps = strpos($target[$n], ':') !== false) {
            $ck++;
            if ($ck === $num) {
              $_REQUEST[substr($target[$n], $ps)] = $request[$n];
              return true;
            }
          }
        }
      }
      return false;
    }
    return false;
  }

  private function _route()
  {
    if ($this->_set_param($this->uri)) {
      $this->_endpoint();
      exit;
    } else if ($this->request === '/error') {
      $this->_endpoint();
      exit;
    }
  }

  private function _endpoint()
  {
    $this->_launch();
    $function =  $this->function;
    $file = $_SERVER['DOCUMENT_ROOT'] . '/' . strtolower($this->controller) . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    
    if (file_exists($file)) {
      require_once $file;
      $module = new $this->controller;
      switch ($this->method) {
        case 'GET':
          $module->{$function}(isset($_SESSION['conn']) ? $_SESSION['conn'] : null, $_REQUEST);
          break;

        case 'POST':
          if ($this->_put_secure($_REQUEST)) {
            $module->{$function}(isset($_SESSION['conn']) ? $_SESSION['conn'] : null, $_REQUEST);
          }
          break;

        default:
          $params = $this->_api_setup();
          if ($this->_put_secure($params)) {
            $module->{$function}(isset($_SESSION['conn']) ? $_SESSION['conn'] : null, $params);
          }
          break;
      }
    }
    exit;
  }

  private function _prepare_config()
  {
    $config = YamlHandler::parsefile($_SERVER['DOCUMENT_ROOT'] . '/app/config.yml');
    define('MODE', $config['mode']);
    define('BASE_URL', \App\Libs\Utils::base_url());
    return $config;
  }

  private function _launch()
  {
    $config = $this->_prepare_config();
    # Setup for Error report
    new \App\Libs\Whoops(MODE);

    # Setup for http header
    new \App\Header(MODE);

    # Setup for render page
    if (empty($_SESSION['_csrf_token']))
      $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));

    if (MODE === 'DEV') {
      define('DB', $config['driver']['mysql']['develope']);
    } else {
      define('DB', $config['driver']['mysql']['production']);
    }
  }

  private function _put_secure($request)
  {
    if (isset($request['_csrf_token']) && hash_equals($request['_csrf_token'], $_SESSION['_csrf_token']))
      return true;
    else 
      return false;
  }

  private function _api_setup()
  {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header("Access-Control-Allow-Methods: '{$this->method}'");
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
    #- use for patch , when not include in $_GET and $_POST
    parse_str(file_get_contents('php://input'), $params);
    return $params;
  }
}
