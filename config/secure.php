<?php
//== PREVENTING SESSION HIJACKING ==//

ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);

session_name('token');
session_start();
session_regenerate_id();

//== GENERATE TOKEN FOR USE IN HTTP REQUEST ==//
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}


