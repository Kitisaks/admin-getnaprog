<?php

class Home extends Plug
{

  function __construct()
  {
    parent::__construct();
    $this->main = strtolower(__CLASS__);
    $this->authenticate();
  }

  public function index()
  {
    $this
      ->view
      ->render($this->main, "index");
  }
}
