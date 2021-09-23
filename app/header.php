<?php

namespace App;

class Header
{
  public $mode;

  function __construct($mode = false)
  {
    $this->mode = $mode;
    $this->_set_header();
    $this->_set_cache();
    $this->_compression();
  }

  private function _set_header()
  {
    //== SET SECURITY ACTIVE WHEN ON PRODUCTION MODE ==//
    if ($this->mode === 'PRO') {
      header('X-Frame-Options: SAMEORIGIN');
      header('X-XSS-Protection: 1; mode=block');
      header('X-Content-Type-Options: nosniff');
      header('X-Powered-By: RainBot 1.2');
      header('Server: RainBot');
      header('Vary: User-Agent,Accept');
      ini_set('display_errors', 0);
      ini_set('log_errors', 1);
    } else {
      header('X-Powered-By: RainBot 1.2');
      header('Server: RainBot');
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
    }
  }

  private function _compression()
  {
    if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
      ob_start('ob_gzhandler');
    else
      ob_start();
  }

  private function _set_cache()
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
}
