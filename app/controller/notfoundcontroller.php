<?php
namespace App\Controller;

use App\View;

class NotfoundController
{
  public function __construct()
  {
    $this->View = new View(__CLASS__);
  }

  public function index()
  {
    $this
    ->View
    ->put_layout(false)
    ->render("index.html");
  }

}
