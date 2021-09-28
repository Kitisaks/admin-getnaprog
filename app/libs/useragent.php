<?php
namespace App\Libs;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Jenssegers\Agent\Agent;

class UserAgent
{
  public static function get_device()
  {
    $agent = new Agent();
    return $agent->device();
  }
  
  public static function get_browser()
  {
    $agent = new Agent();
    return $agent->browser();
  }
  public static function get_platform()
  {
    $agent = new Agent();
    return $agent->platform();
  }

  public static function get_robot()
  {
    $agent = new Agent();
    return $agent->robot();
  }

  public static function is_phone()
  {
    $agent = new Agent();
    return $agent->isPhone();
  }

  public static function is_desktop()
  {
    $agent = new Agent();
    return $agent->isDesktop();
  }

  public static function is_robot()
  {
    $agent = new Agent();
    return $agent->isRobot();
  }

}
