<?php

class Route
{
  function __construct($method, $request, $controller, $function)
  {
    $this->uri = $_SERVER["REQUEST_URI"];
    $this->method = $method;
    $this->request = $request;
    $this->controller = $controller;
    $this->function = $function;
    $this->route();
  }

  private function parse_uri($uri)
  {
    return explode("/", trim($uri, "/"));
  }

  private function set_param()
  {
    $request = $this->parse_uri($this->uri);
    $target = $this->parse_uri($this->request);

    #- Bypass this first
    if ($this->method === $_SERVER["REQUEST_METHOD"]) {
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
          } else if ($ps = strpos($target[$n], ":") !== false) {
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
    } else if ($this->request === "/error") {
      $this->endpoint();
      exit;
    }
  }

  private function endpoint()
  {
    $function =  $this->function;
    $file_name = str_replace("controller", "", strtolower($this->controller));
    $path = $_SERVER["DOCUMENT_ROOT"] . "/controller/{$file_name}_controller.php";
    if (file_exists($path)) {
      require_once $path;
      $module = new $this->controller;
      switch ($this->method) {
        case 'GET':
          $module->$function(isset($_SESSION["conn"]) ? $_SESSION["conn"] : null, $_REQUEST);
          break;

        case 'POST':
          $module->$function(isset($_SESSION["conn"]) ? $_SESSION["conn"] : null, $_REQUEST);
          break;

        default:
          $params = $this->api_setup();
          $module->$function(isset($_SESSION["conn"]) ? $_SESSION["conn"] : null, $params);
      }
    }
    exit;
  }

  private function api_setup()
  {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: '{$this->method}'");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    #- use for patch , when not include in $_GET and $_POST
    parse_str(file_get_contents('php://input'), $params);
    return $params;
  }
}
