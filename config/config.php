<?php
//== SELECT MODE ==//
#- ["DEV", "PRO"]
define("MODE", "DEV");

//== DATABASE CONFIGURATIONS ==//
switch (MODE) {
  case "PRO":
    define("DB", array(
      "NAME" => "bansaing_admin",
      "USER" => "bansaing_admin",
      "PASSWORD" => "Ts02310799",
      "HOST" => "localhost"
    ));
    break;
  
  case "DEV":
    define("DB", array(
      "NAME" => "school_dev",
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


