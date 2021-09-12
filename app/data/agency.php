<?php
namespace App\Data;

class Agency
{
  public static function base_url()
  {
    return 'https://' . $_SESSION['conn']['agency']['sub_domain'] . '.' . $_SESSION['conn']['agency']['cname'];
  }
}