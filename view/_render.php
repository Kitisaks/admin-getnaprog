<?php
define('c', $_SERVER["DOCUMENT_ROOT"] . '/config/');
#- aware to arrange the important desc
require_once c . "libs.php";
require_once c . "config.php";
require_once c . "secure.php";
require_once c . "router.php";
require_once c . "plug.php";
require_once c . "repo.php";
require_once c . "api.php";
require_once c . "view.php";

$app = new Router();
