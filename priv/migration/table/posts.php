<?php
#- keep users information
$table = "posts";
$fields = "
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  agency_id INT(10) UNSIGNED,
  user_id INT(10) UNSIGNED,
  page_id INT(10) UNSIGNED,
  uuid CHAR(50) NOT NULL,
  title VARCHAR(255) NULL,
  content TEXT NULL,
  address VARCHAR(255) NULL,
  city VARCHAR(50) NOT NULL,
  country VARCHAR(50) NULL,
  zip_code VARCHAR(10) NULL,
  phone VARCHAR(15) NULL,
  ip VARCHAR(30) NOT NULL,
  status INT(5) NOT NULL DEFAULT 1,
  inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
  UNIQUE KEY (uuid)
";

print_r(query_sql("table", $table, $fields));
