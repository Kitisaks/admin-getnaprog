<?php
$table = "attachments";
$fields = "
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  agency_id INT(10) UNSIGNED,
  user_id INT(10) UNSIGNED,
  page_id INT(10) UNSIGNED,
  post_id INT(10) UNSIGNED,
  kind VARCHAR(10) NOT NULL,
  title VARCHAR(255) NOT NULL,
  description VARCHAR(255) NULL,
  status INT(5) NOT NULL DEFAULT 1,
  inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
  FOREIGN KEY (agency_id) REFERENCES agencies(id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (page_id) REFERENCES pages(id),
  FOREIGN KEY (post_id) REFERENCES posts(id)
";

print_r(query_sql("table", $table, $fields));
