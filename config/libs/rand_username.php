<?php
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