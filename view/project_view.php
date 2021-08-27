<?php

class ProjectView extends Plug
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
      ->controller
      ->index();

    $this
      ->view
      ->render($this->main, "index");
  }

  public function new()
  {
    $this
      ->view
      ->render($this->main, "new");
  }

  public function create()
  {
    $this
      ->controller
      ->create();
  }
}
