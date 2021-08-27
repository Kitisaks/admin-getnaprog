<?php

class HomeView extends Plug
{
  function __construct()
  {
    parent::__construct();
    $this->main = $this->call(__CLASS__);
    $this->permitted();
  }

  public function index()
  {
    $this
      ->view
      ->render($this->main, "index");
  }
}
