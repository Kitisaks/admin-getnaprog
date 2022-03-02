<?php
#- keep users information
$table = "users";
$fields = "
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(100) NOT NULL,
  name VARCHAR(50) NOT NULL,
  gender CHAR(2) NULL,
  email VARCHAR(100) NOT NULL,
  address VARCHAR(255) NULL,
  city VARCHAR(50) NULL,
  country VARCHAR(50) NULL,
  zip_code VARCHAR(10) NULL,
  phone VARCHAR(20) NOT NULL,
  role INT(5) NOT NULL DEFAULT 1,
  ip VARCHAR(50) NULL,
  status INT(5) NOT NULL DEFAULT 1,
  inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  UNIQUE KEY (username, email)
";

print_r(query_sql("table", $table, $fields));
