<?php

class Main extends Plug{

  function __construct(){
    parent::__construct();
    $this->main = strtolower(get_class($this));
    #- define first for all privacy section
    if(empty($_SESSION["current_user"])){
      header("location: /auth");
      exit;
    }
  }

  public function index(){
    $this
    ->view
    ->render($this->main,"index");
  }

}
