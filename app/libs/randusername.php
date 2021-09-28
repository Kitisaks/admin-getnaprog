<?php
namespace App\Libs;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Uptodown\RandomUsernameGenerator\Generator;

class RandUsername
{
  public static function generate()
  {
    $generator = new Generator();
    $newUsername = $generator->makeNew();
    return $newUsername;
  }
}