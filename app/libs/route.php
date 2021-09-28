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
  public function __construct($method, $request, $controller, $function)
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
    switch ($this->method) {
      case 'GET':
        new \App\Header(MODE);  
        (new $this->controller)
          ->{$this->function}(isset($_SESSION['conn']) ? $_SESSION['conn'] : null, $_REQUEST);
        break;

      case 'POST':
        if ($this->_put_secure($_REQUEST)) {
          (new $this->controller)
            ->{$this->function}(isset($_SESSION['conn']) ? $_SESSION['conn'] : null, $_REQUEST);
        }
        break;

      default:
        $params = $this->_http_method_setup();
        if ($this->_put_secure($params)) {
          (new $this->controller)
            ->{$this->function}(isset($_SESSION['conn']) ? $_SESSION['conn'] : null, $params);
        }
        break;
    }
  }

  private function _prepare_config()
  {
    $config = YamlHandler::parsefile($_SERVER['DOCUMENT_ROOT'] . '/app/config.yml');
    # Setup all config params
    define('MODE', $config['mode']);
    define('BASE_URL', \App\Libs\Utils::base_url());
    define('FTP', $config['driver']['ftp']);
    define('PEPPER_KEY', $config['pepper_key']);

    if (MODE === 'DEV') {
      define('DB', $config['driver']['mysql']['develope']);
    } else {
      define('DB', $config['driver']['mysql']['production']);
    }
  }

  private function _launch()
  {
    $this->_prepare_config();
    # Setup for error report
    new \App\Libs\Whoops(MODE);
    # Setup for HTTP session
    \App\Session::set_cookie_session();
  }

  private function _get_header_csrf()
  {
    return array_filter(
      getallheaders(), 
      fn($k) => $k === 'X-Csrf-Token', 
      ARRAY_FILTER_USE_KEY
    );
  }

  private function _put_secure($request)
  {
    $header = $this->_get_header_csrf();
    if (isset($request['_csrf_token']) && hash_equals($request['_csrf_token'], $_SESSION['_csrf_token']))
      return true;
    elseif (isset($header['X-Csrf-Token']) && hash_equals($header['X-Csrf-Token'], $_SESSION['_csrf_token']))
      return true;
    return false;
  }

  private function _http_method_setup()
  {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header("Access-Control-Allow-Methods: {$this->method}");
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
    #- use for patch , when not include in $_GET and $_POST 
    $input = file_get_contents('php://input');
    if (Utils::is_json($input)) {
      $params = json_decode($input, true);
    } else {
      parse_str($input, $params);
    }
    return $params;
  }
}
