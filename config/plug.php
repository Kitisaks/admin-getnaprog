<?php
class Plug
{
  public static function assign_conn($current_user)
  {
    $_SESSION["conn"]["current_user"] = $current_user;
    $_SESSION["conn"]["agency"] = self::current_agency($current_user);
  }

  private static function current_agency($current_user)
  {
    $repo = new Repo();
    return
      $repo
      ->get("agencies", $current_user["agency_id"]);
  }

  public static function call($call)
  {
    return strtolower(str_replace("View", "", $call));
  }

  public static function permitted()
  {
    if (empty($_SESSION["conn"])) {
      header("location: /auth");
      exit;
    }
  }

  public static function alived()
  {
    if (isset($_SESSION["conn"])) {
      header("location: /home");
      exit;
    }
  }
}
