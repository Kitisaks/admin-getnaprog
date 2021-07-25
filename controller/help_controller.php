<?php

class Help extends Plug{ 
 
  function __construct(){
    parent::__construct();
    echo "inside help";
  }
  public function other(){
    echo "We r in other url";
  }
}