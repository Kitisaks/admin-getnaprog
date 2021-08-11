<?php
//== SELECT MODE ==//
#- ["DEV", "PRO"]
define("MODE", "DEV");

//== DATABASE CONFIGURATIONS ==//
switch (MODE) {
  case "PRO":
    define("DB",
    [
      "NAME" => "getnapro_db",
      "USER" => "getnapro_db",
      "PASSWORD" => "@Fluke160941",
      "HOST" => "localhost"
    ]);
    break;

  case "DEV":
    define("DB", 
    [
      "NAME" => "getprog_db",
      "USER" => "root",
      "PASSWORD" => "@Fluke160941",
      "HOST" => "localhost"
    ]);
    break;
}

//== DEFINE PATH DIRECTORY ==//

##-- r ==> root directory

switch (MODE) {
  case 'PRO':
    define('r', 'https://' . $_SERVER['HTTP_HOST'] . '/');
    break;

  case 'DEV':
    define('r', 'http://' . $_SERVER['HTTP_HOST'] . '/');
    break;
}
