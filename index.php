<?php

$static = [
  'css'  => 'text/css',
  'js'   => 'text/javascript',
  'png'  => 'image/png',
  'gif'  => 'image/gif',
  'jpg'  => 'image/jpg',
  'jpeg' => 'image/jpg',
  'ico' => 'image/x-icon',
  'mp4'  => 'video/mp4'
];

if (php_sapi_name() == 'cli-server') {
  $staticFile = __DIR__ . $_SERVER['REQUEST_URI'];
  if (! file_exists($staticFile)) {
    require_once __DIR__ . '/include/autoload.php';
    new App\Router;
  }

  $type = pathinfo($staticFile, PATHINFO_EXTENSION);

  if (! isset($static[$type])) {
    require_once __DIR__ . '/include/autoload.php';
    new App\Router;
  }

  $path = pathinfo($_SERVER["SCRIPT_FILENAME"]);
  if ($path["extension"] == "el") {
    header("Content-Type: text/x-script.elisp");
    readfile($_SERVER["SCRIPT_FILENAME"]);
  } else {
    header('Content-Type: '. $static[$type]);
    readfile($staticFile);
  }
} else {
  require_once __DIR__ . '/include/autoload.php';
  new App\Router;
}