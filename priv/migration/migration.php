<?php
require_once "../../vendor/autoload.php";

use Symfony\Component\Yaml\Yaml;

$config = Yaml::parseFile("../../app/config.yml");

if ($config['mode'] === 'DEV') {
  define('DB', $config['driver']['mysql']['develope']);
} else {
  define('DB', $config['driver']['mysql']['production']);
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
    return ($e->getMessage() . '<br>');
  }
}

function query_sql($cond, $params1, $params2)
{
  switch ($cond) {
    case "database":
      try {
        $sql = "CREATE DATABASE {$params1}";
        $conn = connect_db();
        $conn->exec($sql);
        return ("Database {$params1} created successfully<br>");
      } catch (PDOException $e) {
        return ($e->getMessage() . '<br>');
      }
      $conn = null;
      break;

    case "table":
      try {
        $sql = "CREATE TABLE {$params1} ({$params2})";
        $conn = connect_db();
        $conn->exec($sql);
        return ("Table {$params1} created successfully<br>");
      } catch (PDOException $e) {
        return ($e->getMessage() . '<br>');
      }
      $conn = null;
      break;
  }
}
