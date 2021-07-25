<?php

class Home extends Plug{

  function __construct(){
    parent::__construct();
    
    if (isset($_SERVER['PHP_AUTH_USER'])){
      $this->view->render("home");
    }else{
      $this->view->render("error");
    }
    
  }

}
