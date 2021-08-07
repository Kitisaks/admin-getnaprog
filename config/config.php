<?php
//== SELECT MODE ==//
#- ["DEV", "PRO"]
define("MODE", "DEV");

//== DATABASE CONFIGURATIONS ==//
switch (MODE) {
  case "PRO":
    define("DB", array(
      "NAME" => "database_name",
      "USER" => "database_user",
      "PASSWORD" => "database_password",
      "HOST" => "database_host"
    ));
    break;
  
  case "DEV":
    define("DB", array(
      "NAME" => "database_name",
      "USER" => "root",
      "PASSWORD" => "",
      "HOST" => "localhost"
    ));
    break;
}

//== DEFINE PATH DIRECTORY ==//

##-- r ==> root directory

switch (MODE) {
  case 'PRO':
    define('r', 'https://'. $_SERVER['HTTP_HOST'] .'/');
    break;
  
  case 'DEV':
    define('r', 'http://'. $_SERVER['HTTP_HOST'] .'/');
    break;
}


