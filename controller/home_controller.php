<?php

class HomeController extends Plug
{
  function __construct()
  {
    Session::permitted();
    $this->view = new View(__CLASS__);
  }

  public function index()
  {
    $this->view->render("index.html");
  }
}