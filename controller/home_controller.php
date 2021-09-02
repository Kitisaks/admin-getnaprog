<?php

class HomeController
{
  function __construct()
  {
    Plug::permitted();
    $this->view = new View(__CLASS__);
    $this->repo = new Repo();
  }

  public function index()
  {
    $this->view->render("index.html");
  }
}