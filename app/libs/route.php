<?php
namespace App\Libs;

class Route
{
  private $uri;
  private $method;
  private $request;
  private $controller;
  private $function;

  function __construct($method, $request, $controller, $function)
  {
    $this->uri = $_SERVER['REQUEST_URI'];
    $this->method = $method;
    $this->request = $request;
    $this->controller = $controller;
    $this->function = $function;
    $this->route();
  }

  private function parse_uri($uri)
  {
    if (strpos($uri, '?') !== false) {
      $req = explode('/', trim(substr($uri, 0, strpos($uri, '?')), '/'));
    } else {
      $req = explode('/', trim($uri, '/'));
    }
    return $req;
  }

  private function set_param()
  {
    $request = $this->parse_uri($this->uri);
    $target = $this->parse_uri($this->request);

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

  /**
   * To Create * Do Not * add /example/:id and /example/test like this!
   * It will route to first item that found in this by top to bot
   * Please reorder route like this 
   * /example/test1
   * /example/test2
   * /example/:id
   */
  private function route()
  {
    if ($this->set_param($this->uri)) {
      $this->endpoint();
      exit;
    } else if ($this->request === '/error') {
      $this->endpoint();
      exit;
    }
  }

  private function endpoint()
  {
    $this->launch();
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
          if ($this->put_secure($_REQUEST)) {
            $module->{$function}(isset($_SESSION['conn']) ? $_SESSION['conn'] : null, $_REQUEST);
          }
          break;

        default:
          $params = $this->api_setup();
          if ($this->put_secure($params)) {
            $module->{$function}(isset($_SESSION['conn']) ? $_SESSION['conn'] : null, $params);
          }
          break;
      }
    }
    exit;
  }

  private function launch()
  {
    # Setup for render page
    if (empty($_SESSION['_csrf_token']))
      $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));

    $config = YamlHandler::parsefile($_SERVER['DOCUMENT_ROOT'] . '/app/config.yml');
    if (MODE === 'DEV') {
      define('DB', $config['driver']['mysql']['develope']);
      define('r', $config['domain']['develope']);
    } else {
      define('DB', $config['driver']['mysql']['production']);
      define('r', $config['domain']['production']);
    }
  }

  private function put_secure($request)
  {
    if (isset($request['_csrf_token']) && hash_equals($request['_csrf_token'], $_SESSION['_csrf_token']))
      return true;
    else 
      return false;
  }

  private function api_setup()
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
