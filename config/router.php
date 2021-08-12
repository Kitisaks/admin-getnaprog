<?php
class Router
{
  function __construct()
  {
    require_once "error_view.php";
    $notfound = new Notfound();
    $url = isset($_GET["url"]) ? $_GET["url"] : null;
    $url = rtrim($url, "/");
    $url = explode("/", $url);

    $file = $url[0] . "_view.php";

    if (file_exists($file)) {
      require_once $file;
    } else {
      $notfound->index();
      return false;
    }

    $render = new $url[0];
    $render->loadmodule($url[0]);

    if (isset($url[2])) {
      $render->{$url[1]}($url[2]);
    } else {
      if (isset($url[1])) {
        if (method_exists($render, $url[1]) == true) {
          $render->{$url[1]}();
        } else {
          $notfound->index();
          return false;
        }
      } else {
        $render->index();
      }
    }
  }
}
