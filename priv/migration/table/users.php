<?php
require_once "../migration.php";

#- keep users information
$sql = "CREATE TABLE users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  role INT(5) NOT NULL DEFAULT 1,
  ip VARCHAR(30) NOT NULL,

  inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  UNIQUE(username, email)
)";

print_r(query_sql("table", $sql));
