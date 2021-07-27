<?php
class Help extends Plug{ 
 
  function __construct(){
    parent::__construct();
    $this->main = strtolower(get_class($this));
  }

  public function index(){
    echo "index";
  }

  public function other(){
    echo "We r in other url";
  }

}