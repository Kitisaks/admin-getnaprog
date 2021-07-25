<?php
class View{

  function __construct(){
  }

  public function render($page){
    header("X-Frame-Options: SAMEORIGIN");
    header("X-XSS-Protection: 1; mode=block");
    header("X-Content-Type-Options: nosniff");
    header("Content-Security-Policy: default-src 'self'");
    header("Cache-Control: must-revalidate");
    header("Vary: User-Agent");
    require "../view/". $page .".php";
  }
}