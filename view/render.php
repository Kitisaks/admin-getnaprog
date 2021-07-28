<?php
define('c', '../config/');

#- modules required
require_once c."config.php";
require_once c."secure.php";
require_once c."router.php";
require_once c."plug.php";
require_once c."repo.php";
require_once c."view.php";

#- libraries included



$app = new Router();