<?php
require_once "../connection.php";

#- change db name if you want.
$sql = "CREATE DATABASE school_dev";

print_r(query_sql("database", $sql));