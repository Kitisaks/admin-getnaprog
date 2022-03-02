<?php
namespace App\Controller;

use App\View;

class PageController
{
  public function __construct()
  {
    $this->View = new View(__CLASS__);
  }


  public function index()
  {
    $this
    ->View
    ->render("index.html");
  }
}
