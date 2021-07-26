<?php
class Auth extends Plug{

  private $main;

  function __construct(){
    parent::__construct();
    $this->main = strtolower(get_class($this));
  }
  
  public function index(){
    $this->view->render($this->main,"index");
  }

  public function register(){
    $this->view->render($this->main,"register");
  }

}