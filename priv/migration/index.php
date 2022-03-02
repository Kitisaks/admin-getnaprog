============ CREATE NEW DATABASE ============
<?php
#- Create databases
require_once __DIR__ . "/migration.php";
require_once __DIR__ . "/database/pg.php";

#- Create tables
require_once __DIR__ . "/table/users.php";
//==== put more if want .. ====//
?>
================ FINISHED ================