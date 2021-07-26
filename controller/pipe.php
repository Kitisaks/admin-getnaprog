<?php
define('c', '../config/');

#- modules required
require c."config.php";
require c."secure.php";
require c."router.php";
require c."plug.php";
require c."view.php";

#- libraries included

$app = new Router();