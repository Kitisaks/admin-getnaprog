<?php
define('MODE', 'DEV');

require_once __DIR__ . '/app/secure.php';
require_once __DIR__ . '/include/autoload.php';

$app = new App\Router;
$whoops = new App\Libs\Whoops;

