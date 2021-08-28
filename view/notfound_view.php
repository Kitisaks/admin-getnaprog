<?php

class NotfoundView extends Plug
{

  function __construct()
  {
    parent::__construct();
    $this->main = $this->call(__CLASS__);
  }

  public function index()
  {
    $this
      ->view
      ->layout(false)
      ->render($this->main, "index");
  }
}
