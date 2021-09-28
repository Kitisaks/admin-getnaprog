<?php
require_once "../../vendor/autoload.php";

use Symfony\Component\Yaml\Yaml;

$config = Yaml::parseFile("../../app/config.yml");

if ($config['mode'] === 'DEV') {
  define('DB', $config['driver']['mysql']['develope']);
} else {
  define('DB', $config['driver']['mysql']['production']);
}

function connect()
{
  try {
    return new PDO(
      'mysql:host=' . DB['host'] . ';port=' . DB['port'] . ';charset=utf8',
      DB['user'],
      DB['password'],
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
  } catch (PDOException $e) {
    return (date("h:i:s") . "---- " . $e->getMessage() . PHP_EOL);
  }
}

function connect_db()
{
  try {
    return new PDO(
      'mysql:host=' . DB['host'] . ';dbname=' . DB['name'] . ';port=' . DB['port'] . ';charset=utf8',
      DB['user'],
      DB['password'],
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
  } catch (PDOException $e) {
    return (date("h:i:s") . "---- " . $e->getMessage() . PHP_EOL);
  }
}

$initial = 0;
$total = count(glob(__DIR__ . '/database/*')) + count(glob(__DIR__ . '/table/*'));

function query_sql($cond, $param1, $param2 = null)
{
  global $initial,$total;
  $initial++;
  switch ($cond) {
    case "database":
      try {
        $conn = connect();
        $sql = "CREATE DATABASE {$param1}";
        $conn->exec($sql);
        $done = (string)(round($initial/$total*100));
        return ("{$done}%---- Database " . ucfirst($param1) . ' created successfully' . PHP_EOL);
      } catch (PDOException $e) {
        return (date("h:i:s") . "---- " . $e->getMessage() . PHP_EOL);
      }
      break;

    case "table":
      try {
        $conn = connect_db();
        $sql = "CREATE TABLE {$param1} ({$param2})";
        $conn->exec($sql);
        $done = (string)(round($initial/$total*100));
        return ("{$done}%---- Table " . ucfirst($param1) . ' created successfully' . PHP_EOL);
      } catch (PDOException $e) {
        return (date("h:i:s") . "---- " . $e->getMessage() . PHP_EOL);
      }
      break;
  }
  $conn = null;
}
