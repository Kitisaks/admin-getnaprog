<?php
$table = "attachments";
$fields = "
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  agency_id INT(10) UNSIGNED,
  user_id INT(10) UNSIGNED,
  page_id INT(10) UNSIGNED,
  post_id INT(10) UNSIGNED,
  name VARCHAR(255) NOT NULL,
  kind VARCHAR(10) NOT NULL,
  title VARCHAR(255) NOT NULL,
  description VARCHAR(255) NULL,
  type VARCHAR(50) NULL,
  status INT(5) NOT NULL DEFAULT 1,
  inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
  FOREIGN KEY (agency_id) REFERENCES agencies(id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (page_id) REFERENCES pages(id),
  FOREIGN KEY (post_id) REFERENCES posts(id)
";

print_r(query_sql("table", $table, $fields));
