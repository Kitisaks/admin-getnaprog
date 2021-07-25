<?php
class Auth extends Plug{

  function __construct(){
    parent::__construct();

    $this->view->render("auth");
  }
}