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
  meta_title VARCHAR(255) NULL,
  meta_description VARCHAR(255) NULL,
  meta_keyword VARCHAR(255) NULL,
  status INT(5) NOT NULL DEFAULT 1,
  inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
  UNIQUE KEY (uuid),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (agency_id) REFERENCES agencies(id)
";

print_r(query_sql("table", $table, $fields));
