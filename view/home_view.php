<?php

class Home extends Plug
{

  function __construct()
  {
    parent::__construct();
    $this->main = strtolower(get_class($this));
  }

  public function index()
  {
    $this
      ->view
      ->render($this->main, "index");
  }
}
