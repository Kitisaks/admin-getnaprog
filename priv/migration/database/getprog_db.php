<?php
#- change db name if you want.
$db = "getprog_db";

print_r(query_sql("database", $db, null));
