<?php
namespace App;

class Session
{
  public static function set_cookie_session()
  {
    if (empty($_SESSION['__host']))
      session_start([
        'name' => '__host',
        'cookie_httponly' => 1,
        'use_only_cookies' => 1,
        'cookie_secure' => 1,
        'gc_maxlifetime' => 1440,
        'gc_probability' => 1,
        'gc_divisor' => 1,
        'sid_length' => 128,
        'cache_limiter' => 'nocache',
        'save_path' => $_SERVER['DOCUMENT_ROOT'] . '/priv/server/sessions'
      ]);
    session_regenerate_id(true);

    if (empty($_SESSION['_csrf_token']))
      $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
  }

  public static function assign_conn($user, $agency)
  {
    $_SESSION['conn']['current_user'] = [
      'id' => $user['id'],
      'uuid' => $user['uuid'],
      'name' => $user['name'],
      'email' => $user['email'],
      'role' => $user['role']
    ];
    $_SESSION['conn']['agency'] = [
      'id' => $agency['id'],
      'uuid' => $agency['uuid'],
      'name' => $agency['name'],
      'cname' => $agency['cname'],
      'email' => $agency['email'],
      'host' => $agency['host']
    ];
  }

  public static function call($call)
  {
    return strtolower(str_replace('View', '', $call));
  }

  public static function permitted()
  {
    if (empty($_SESSION['conn'])) {
      header('location: /auth');
      exit;
    }
  }

  public static function alived()
  {
    if (isset($_SESSION['conn'])) {
      header('location: /content');
      exit;
    }
  }
}
