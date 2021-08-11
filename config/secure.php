<?php

//== PREVENTING SESSION HIJACKING ==//
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
#- set for 1 hour
ini_set('session.gc_maxlifetime', 60 * 60);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_name('token');
session_start();
session_regenerate_id();

//== GENERATE TOKEN FOR USE IN HTTP REQUEST ==//
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(35));
}

//== SET SECURITY ACTIVE WHEN ON PRODUCTION MODE ==//
if (MODE == "PRO") {
  header("X-Frame-Options: SAMEORIGIN");
  header("X-XSS-Protection: 1; mode=block");
  header("X-Content-Type-Options: nosniff");
  header("Vary: User-Agent,Accept");
} else {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
