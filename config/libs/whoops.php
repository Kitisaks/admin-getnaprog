<?php

use \Whoops\Run;
use \Whoops\Handler\PrettyPageHandler;
define("MODE", "DEV");

if (MODE === "DEV") {
  $whoops = new Run;
  $whoops->pushHandler(new PrettyPageHandler);
  $whoops->register();
}
