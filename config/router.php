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
    $n = count($url) - 1;
    $file = $url[0] . "_view.php";

    if (file_exists($file)) {
      require_once $file;
    } else {
      $notfound->index();
      return false;
    }

    $render = new $url[0];
    $render->loadmodule($url[0]);

    if ($n >= 1) {
      if (method_exists($render, $url[$n])) {
        $render->{$url[$n]}();
      } else {
        $notfound->index();
        return false;
      }
    } else {
      $render->index();
    }
  }
}
