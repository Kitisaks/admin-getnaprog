<?php
if (empty($_SESSION['_rainBID']))
  session_start([
    'name' => '_rainBID',
    'cookie_httponly' => 1,
    'use_only_cookies' => 1,
    'cookie_secure' => 1,
    'gc_maxlifetime' => 1440,
    'gc_probability' => 1,
    'gc_divisor' => 1,
    'sid_length' => 22,
    'cache_expire' => (MODE === 'DEV') ? 0 : 24,
    'cache_limiter' => 'private_no_expire',
    'save_path' => $_SERVER['DOCUMENT_ROOT'] . '/priv/server/sessions'
  ]);
session_regenerate_id(true);

//== SET SECURITY ACTIVE WHEN ON PRODUCTION MODE ==//
if (MODE === 'PRO') {
  header('X-Frame-Options: SAMEORIGIN');
  header('X-XSS-Protection: 1; mode=block');
  header('X-Content-Type-Options: nosniff');
  header('X-Powered-By: RainBot 1.2');
  header('Server: RainBot');
  header('Vary: User-Agent,Accept');
  set_cache();
  ini_set('display_errors', 0);
  ini_set('log_errors', 1);
} else {
  header('X-Powered-By: RainBot 1.2');
  header('Server: RainBot');
  set_cache();
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

function set_cache()
{
  $tsstring = gmdate('D, d M Y H:i:s ', time()) . 'GMT';
  $etag = md5($_SERVER["HTTP_ACCEPT_LANGUAGE"] . time());
  $if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false;
  $if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? $_SERVER['HTTP_IF_NONE_MATCH'] : false;
  if ((($if_none_match && $if_none_match == $etag) || (!$if_none_match)) &&
    ($if_modified_since && $if_modified_since == $tsstring)
  ) {
    header('HTTP/1.1 304 Not Modified');
    exit();
  } else {
    header("Last-Modified: $tsstring");
    header("ETag: \"{$etag}\"");
  }
}
