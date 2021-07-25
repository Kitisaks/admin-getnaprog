<?php
class Notfound extends Plug{

  function __construct(){
    parent::__construct();

    $this->view->render("error");
  }
}