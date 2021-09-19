<?php
require_once "../../vendor/autoload.php";

use Symfony\Component\Yaml\Yaml;

$config = Yaml::parseFile("../../app/config.yml");

if ($config['mode'] === 'DEV') {
  define('DB', $config['driver']['mysql']['develope']);
} else {
  define('DB', $config['driver']['mysql']['production']);
}

$datetime = date("d/m/Y h:i:sa");

function connect_db()
{
  global $datetime;
  try {
    return new PDO(
      'mysql:host=' . DB['host'] . ';dbname=' . DB['name'] . ';port=' . DB['port'] . ';charset=utf8',
      DB['user'],
      DB['password'],
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
  } catch (PDOException $e) {
    return ($datetime.": ".$e->getMessage() . PHP_EOL);
  }
}

function query_sql($cond, $params1, $params2)
{
  global $datetime;
  switch ($cond) {
    case "database":
      try {
        $sql = "CREATE DATABASE {$params1}";
        $conn = connect_db();
        $conn->exec($sql);
        return ("{$datetime}: Database {$params1} created successfully" . PHP_EOL);
      } catch (PDOException $e) {
        return ($datetime.": ".$e->getMessage() . PHP_EOL);
      }
      $conn = null;
      break;

    case "table":
      try {
        $sql = "CREATE TABLE {$params1} ({$params2})";
        $conn = connect_db();
        $conn->exec($sql);
        return ("{$datetime}: Table {$params1} created successfully" . PHP_EOL);
      } catch (PDOException $e) {
        return ($datetime.": ".$e->getMessage() . PHP_EOL);
      }
      $conn = null;
      break;
  }
}
