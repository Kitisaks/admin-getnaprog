<?php
namespace App\Controller;

use App\Plug;
use App\View;
use App\Session;

class ContentController extends Plug
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