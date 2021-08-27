<?php
//== GENERATE TOKEN FOR USE IN HTTP REQUEST ==//
if (empty($_SESSION["_rainBID"]))
  session_start([
    "name" => "_rainBID",
    "cookie_httponly" => 1,
    "use_only_cookies" => 1,
    "cookie_secure" => 1,
    "gc_maxlifetime" => 1440,
    "gc_probability" => 1,
    "gc_divisor" => 1,
    "sid_length" => 64,
    "cache_expire" => (MODE === "DEV") ? 0 : 24,
    "cache_limiter" => (MODE === "DEV") ? "nocache" : "public",
    "save_path" => $_SERVER["DOCUMENT_ROOT"] . "/priv/server/sessions"
  ]);
session_regenerate_id(true);

//== SET SECURITY ACTIVE WHEN ON PRODUCTION MODE ==//
if (MODE == "PRO") {
  header("X-Frame-Options: SAMEORIGIN");
  header("X-XSS-Protection: 1; mode=block");
  header("X-Content-Type-Options: nosniff");
  header("X-Powered-By: RainBot 1.2");
  header("Server: RainBot");
  header("Vary: User-Agent,Accept");
  ini_set("display_errors", 0);
  ini_set("log_errors", 1);
} elseif (MODE == "DEV") {
  header("X-Powered-By: RainBot 1.2");
  header("Server: RainBot");
  ini_set("display_errors", 1);
  ini_set("display_startup_errors", 1);
  error_reporting(E_ALL);
}