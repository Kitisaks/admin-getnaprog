<?php
namespace App\Controller;

use App\{Repo,View,Session};

class ContentController
{
  public function __construct()
  {
    Session::permitted();
    $this->Repo = new Repo();
    $this->View = new View(__CLASS__);
  }

  public function index()
  {
    $this->View->render("index.html");
  }
}