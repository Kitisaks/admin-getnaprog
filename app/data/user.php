<?php
namespace App\Data;

class User
{
  public static function permitted($current_user, int $post_id): bool
  {
    if ($current_user['id'] === $post_id || $current_user['role'] >= 3)
      return true;
    else
      return false;
  }

}