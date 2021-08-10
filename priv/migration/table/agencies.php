<?php
$table = "agencies";
$fields = "
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  cname VARCHAR(50) NOT NULL,
  title VARCHAR(255) NULL,
  description VARCHAR(255) NULL,
  address VARCHAR(100) NULL,
  city VARCHAR(50) NULL,
  country VARCHAR(50) NULL,
  zip_code VARCHAR(10) NULL,
  phone VARCHAR(15) NULL,
  domain VARCHAR(30) NOT NULL,
  meta_title VARCHAR(255) NULL,
  meta_description VARCHAR(255) NULL,
  meta_keyword VARCHAR(255) NULL,
  status INT(5) NOT NULL DEFAULT 1,
  inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
  UNIQUE KEY (cname)
";

print_r(query_sql("table", $table, $fields));
