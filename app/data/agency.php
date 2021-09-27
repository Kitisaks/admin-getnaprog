<?php
namespace App\Data;

use App\Repo;

class Agency
{
  public static function base_url($agency)
  {
    return 'https://' . $agency['host'];
  }

  public static function get_name($agency)
  {
    $agency = (new Repo)->get('agencies', $agency['id']);
    return $agency['cname'];
  }
}