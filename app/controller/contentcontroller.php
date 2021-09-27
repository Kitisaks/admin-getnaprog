<?php
namespace App\Controller;

use 
  App\Plug, 
  App\View, 
  App\Session;

class ContentController extends Plug
{
  public function __construct()
  {
    Session::permitted();
    $this->view = new View(__CLASS__);
  }

  public function index()
  {
    $this->view->render("index.html");
  }
}