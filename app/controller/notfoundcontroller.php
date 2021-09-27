<?php
namespace App\Controller;

use App\View;

class NotfoundController
{
  public function __construct()
  {
    $this->view = new View(__CLASS__);
  }

  public function index()
  {
    $this
    ->view
    ->put_layout(false)
    ->render("index.html");
  }

}
