<?php
$table = "pages";
$fields = "
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  agency_id INT(10) UNSIGNED,
  user_id INT(10) UNSIGNED,
  uuid CHAR(50) NOT NULL,
  permalink VARCHAR(100) NULL,
  title VARCHAR(140) NULL,
  description VARCHAR(255) NULL,
  content TEXT NULL,
  meta_title VARCHAR(255) NULL,
  meta_description VARCHAR(255) NULL,
  meta_keyword VARCHAR(255) NULL,
  status INT(5) NOT NULL DEFAULT 1,
  inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
  UNIQUE KEY (uuid)
";

print_r(query_sql("table", $table, $fields));
