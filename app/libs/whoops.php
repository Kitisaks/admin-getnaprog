<?php
namespace App\Libs;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use 
  \Whoops\Run, 
  \Whoops\Handler\PrettyPageHandler;

class Whoops
{
  function __construct(string $mode)
  {
    if ($mode === 'DEV') {
      $whoops = new Run;
      $whoops->pushHandler(new PrettyPageHandler);
      $whoops->register();
    }
  }
}

