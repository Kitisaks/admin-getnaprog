<?php

class Home extends Plug{

  function __construct(){
    parent::__construct();
    
    $this->view->render("error");

    
  }

}
