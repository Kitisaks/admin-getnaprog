<?php

class Tools extends Plug
{

  function __construct()
  {
    parent::__construct();
    $this->main = strtolower(__CLASS__);
  }

  public function index()
  {
    $this
    ->view
    ->render($this->main, "index", 1);
  }

  public function genuuid()
  {
    $this
    ->view
    ->render($this->main, "genuuid", 1);
  }
}