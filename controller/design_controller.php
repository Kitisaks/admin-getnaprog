<?php
class DesignController
{
  function __construct()
  {
    Plug::permitted();
    $this->view = new View(__CLASS__);
    $this->repo = new Repo();
  }

  public function index($conn, $params) 
  {
    $this
    ->view
    ->render("index.html");
  }


}