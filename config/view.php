<?php
class View{

  function __construct(){
  }

  public function render($page){
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');
    header('X-Content-Type-Options: nosniff');
    require "../view/". $page .".php";
  }
}