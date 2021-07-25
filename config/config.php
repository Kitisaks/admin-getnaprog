<?php
//== SELECT MODE ==//
#- ["DEV", "PRO"]
define("MODE", "DEV");

//== DATABASE CONFIGURATIONS ==//
switch (MODE) {
  case "PRO":
    define("DB", array(
      "NAME" => "bansaingam_database",
      "USER" => "bansaingam_database",
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

//== ROOT DIRECTORY FOR VIEW ==//
define("v", "../template");
