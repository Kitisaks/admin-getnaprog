<?php

class Auth extends Plug{

  function __construct(){
    parent::__construct();
    $this->main = strtolower(get_class($this));
  }
  
  public function index(){
    $this
    ->view
    ->render($this->main,"index",1);
  }

  public function login(){
    $this
    ->controller
    ->login();
  }

  public function register(){
    $this
    ->view
    ->render($this->main,"register",1);
  }

  public function add(){
    $this
    ->controller
    ->register();
  }

  public function logout(){
    session_destroy();
    header("location: /auth");
  }

}