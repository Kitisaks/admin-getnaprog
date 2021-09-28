<?php
namespace App\Controller;

use App\View;

class ToolsController
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
      ->render('index.html');
  }

  public function genuuid()
  {
    $this
    ->View
    ->put_layout(false)
    ->render('genuuid.html');
  }

}