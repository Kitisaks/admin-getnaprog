<?php
class Router
{
  function __construct(){
    $url = isset($_GET["url"]) ? $_GET["url"] : null;
    $url = rtrim($url, "/");
    $url = explode("/", $url);

    $file = $url[0] . "_controller.php";
    
    if(file_exists($file)){
      require $file;
    }else{
      require "error_controller.php";
      $controller = new Notfound();
      $controller->index();
      return false;
    }

    $controller = new $url[0];

    if(isset($url[2])){
      $controller->{$url[1]}($url[2]);
    }else{
      if(isset($url[1])){
        if(method_exists($controller, $url[1]) == true){
          $controller->{$url[1]}();
        }else{
          require "error_controller.php";
          $controller = new Notfound();
          $controller->index();
          return false;
        }
      }else{
        $controller->index();
      }
    }
  }
}
