<?php
class View{

  function __construct(){
  }

  public function render($page){
    require "../view/". $page .".php";
  }
}