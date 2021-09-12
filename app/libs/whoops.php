<?php
namespace App\Libs;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use \Whoops\Run;
use \Whoops\Handler\PrettyPageHandler;
class Whoops
{
  function __construct()
  {
    if (MODE === 'DEV') {
      $whoops = new Run;
      $whoops->pushHandler(new PrettyPageHandler);
      $whoops->register();
    }
  }
}


