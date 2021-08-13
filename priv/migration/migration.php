<?php
require "../../config/config.php";

function query_sql($cond, $params1, $params2)
{
  switch ($cond) {
    case "database":
      try {
        $conn = new PDO("mysql:host=" . DB["HOST"], DB["USER"], DB["PASSWORD"]);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE DATABASE $params1";

        $conn->exec($sql);
        return ("Database $params1 created successfully<br>");
      } catch (PDOException $e) {
        return ($e->getMessage() . "<br>");
      }
      $conn = null;
      break;

    case "table":
      try {
        $conn = new PDO("mysql:host=" . DB["HOST"] . ";dbname=" . DB["NAME"], DB["USER"], DB["PASSWORD"]);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE $params1 ($params2)";

        $conn->exec($sql);

        return ("Table $params1 created successfully<br>");
      } catch (PDOException $e) {
        return ($e->getMessage() . "<br>");
      }

      $conn = null;
      break;
  }
};
