<?php
namespace App\Controller;

use App\View;

class ErrorController
{
  public function __construct()
  {
    $this->View = new View(__CLASS__);
  }

  public function notfound_404()
  {
    $this
    ->View
    ->put_layout("external.html")
    ->render("404.html");
  }

}