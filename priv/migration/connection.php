<?php
require "../../../config/config.php";

function query_sql($cond,$params){
  switch ($cond) {
    case "database":
        try{
          $conn = new PDO("mysql:host=" . DB["HOST"], DB["USER"], DB["PASSWORD"]);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
          $sql = $params;
      
          $conn->exec($sql);
          return("Database created successfully<br>");
        }catch(PDOException $e){
          return($sql . "<br>" . $e->getMessage());
        }
        $conn = null;
      break;
    
    case "table":
        try{
          $conn = new PDO("mysql:host=" . DB["HOST"] . ";dbname=" . DB["NAME"], DB["USER"], DB["PASSWORD"]);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = $params;

          $conn->exec($sql);
          return("Table users created successfully");
        }catch(PDOException $e){
          return($sql . "<br>" . $e->getMessage());
        }
        
        $conn = null;
      break;
  }
};
