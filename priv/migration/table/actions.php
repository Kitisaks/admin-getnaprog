<?php
$table = "actions";
$fields = "
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  agency_id INT(10) UNSIGNED,
  page_id INT(10) UNSIGNED,
  ip VARCHAR(50) NOT NULL,
  permalink VARCHAR(100) NULL,
  devices VARCHAR(100) NULL,
  inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
  FOREIGN KEY (agency_id) REFERENCES agencies(id),
  FOREIGN KEY (page_id) REFERENCES pages(id)
";

print_r(query_sql("table", $table, $fields));
