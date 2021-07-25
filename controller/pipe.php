<?php
define('c', '../config/');

#- require all files from config folder
require c."config.php";
require c."secure.php";
require c."router.php";
require c."plug.php";
require c."view.php";

$app = new Router();