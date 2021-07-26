<?php

class Home extends Plug{

  private $main;
  
  function __construct(){
    parent::__construct();
    $this->main = strtolower(get_class($this));
  }

}
