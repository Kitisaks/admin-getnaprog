<?php
namespace App\Libs;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use 
  Symfony\Component\Yaml\Yaml, 
  Symfony\Component\Yaml\Exception\ParseException;

class YamlHandler
{
  public static function parse($content)
  {
    try {
      return Yaml::parse($content);
    } catch (ParseException $exception) {
      printf('Unable to parse the YAML string: %s', $exception->getMessage());
      exit;
    }
  }

  public static function parsefile($path)
  {
    try {
      return Yaml::parseFile($path);
    } catch (ParseException $exception) {
      printf('Unable to parse the YAML file: %s', $exception->getMessage());
      exit;
    }
  }
}