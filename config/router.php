<?php
final class Router
{
  function __construct()
  {
    require_once "error_view.php";
    $this->notfound = new NotfoundView();
    $this->uri = $this->uri($_GET["url"]);

    switch ($_GET["url"]) {

      #- /auth
      case "auth": $this->route("index"); break;
      case "auth/login": $this->route("login"); break;
      case "auth/signup": $this->route("signup"); break;
      case "auth/signout": $this->route("signout"); break;
      case "auth/reset": $this->route("reset"); break;
      case "auth/add": $this->route("add"); break;

      #- /home
      case "home": $this->route("index"); break;

      #- /project
      case "project": $this->route("index"); break;
      case "project/new": $this->route("new"); break;
      case "project/create": $this->route("create"); break;

      #- /tools
      case "tools": $this->route("index"); break;
      case "tools/genuuid": $this->route("genuuid"); break;

      
      default: $this->notfound->index(); break;
    }
  }

  private function uri($url)
  {
    return explode("/", rtrim(isset($url) ? $url : null, "/"));
  }

  private function loadview()
  {
    $file = $this->uri[0] . "_view.php";

    if (file_exists($file)) {
      require_once $file;
      $class = ucfirst($this->uri[0]) . "View";
      $render = new $class;
      return $render;
    } else {
      $this->notfound->index();
      exit;
    }
  }

  private function route($get)
  {
    #- Load View
    $view = $this->loadview();
    #- Load Controller
    $view->loadmodule($this->uri[0]);

    $this->prepare($view, $get);
  }

  private function prepare($view, $method)
  {
    if (method_exists($view, $method)) {
      $view->$method();
      exit;
    } else {
      $this->notfound->index();
      exit;
    }
  }
}
