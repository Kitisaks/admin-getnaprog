<?php

namespace App\Data;

use App\{Repo,Libs};

class User
{
  public function __construct() 
  {
    $this->Repo = new Repo;
  }

  public function permitted($current_user, int $post_id): bool
  {
    if ($current_user['id'] === $post_id || $current_user['role'] >= 3)
      return true;
    else
      return false;
  }

  public function create($params)
  {
    $agency =
      $this
      ->Repo
      ->select("id")
      ->from("agencies")
      ->where("uuid = '{$params['agency_id']}'")
      ->one();

    $user = [
      "agency_id" => $agency["id"],
      "name" => trim($params["name"]),
      "username" => strtolower(trim($params["username"])),
      "password" => Libs\Utils::encrypt_sha256(trim($params["password"])),
      "email" => strtolower(trim($params["email"])),
      "gender" => trim($params["gender"]),
      "phone" => trim($params["phone"]),
      "ip" => trim($params["ip"]),
      "uuid" => Libs\GenUuid::uuid6()
    ];

    if ($this->Repo->insert("users", $user))
      return true;
    else 
      return false;
  }
}
