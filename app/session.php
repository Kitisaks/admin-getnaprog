<?php

namespace App;

class Session
{
  public static function set_cookie_session()
  {
    if (empty($_SESSION['__host']))
      session_start([
        'name' => '__token',
        'cookie_httponly' => 1,
        'save_path' => $_SERVER['DOCUMENT_ROOT'] . '/priv/server/sessions'
      ]);
    session_regenerate_id(true);

    if (empty($_SESSION['_csrf_token']))
      $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
  }
}
