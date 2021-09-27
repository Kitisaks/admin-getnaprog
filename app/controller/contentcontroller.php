<?php
namespace App\Controller;

use 
  App\Repo, 
  App\View, 
  App\Session;

class ContentController
{
  public function __construct()
  {
    Session::permitted();
    $this->repo = new Repo();
    $this->view = new View(__CLASS__);
  }

  public function index()
  {
    $this->view->render("index.html");
  }
}