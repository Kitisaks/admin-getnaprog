<?php
$table = "attachments";
$fields = "
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  agency_id INT(10) UNSIGNED,
  page_id INT(10) UNSIGNED,
  user_id INT(10) UNSIGNED,
  kind_id INT(10) UNSIGNED,
  kind VARCHAR(10) NOT NULL,
  obj VARCHAR(255) NULL,
  obj_id INT(10) UNSIGNED,
  url VARCHAR(255) NULL,
  description VARCHAR(255) NULL,
  type VARCHAR(50) NULL,
  inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
";

print_r(query_sql("table", $table, $fields));
