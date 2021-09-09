<?php
class Session
{
  public static function assign_conn($user)
  {
    $_SESSION["conn"]["current_user"] = [
      "id" => $user["id"],
      "uuid" => $user["uuid"],
      "name" => $user["name"],
      "email" => $user["email"],
      "role" => $user["role"]
    ];
    $_SESSION["conn"]["agency"] = self::current_agency($user["agency_id"]);
  }

  private static function current_agency($agency_id)
  {
    $agency = (new Repo())->get("agencies", $agency_id);
    return [
      "id" => $agency["id"],
      "uuid" => $agency["uuid"],
      "name" => $agency["name"],
      "cname" => $agency["cname"],
      "email" => $agency["email"],
      "domain" => $agency["domain"],
      "sub_domain" => $agency["sub_domain"]
    ];
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
