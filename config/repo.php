<?php
#- all query db follow in here.
class Repo{
  
  function __construct(){
    $this->conn = new PDO("mysql:host=".DB["HOST"].";dbname=".DB["NAME"], DB["USER"], DB["PASSWORD"]);
    $this
    ->conn
    ->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
      );
  }

  #- Fetch all record in table by ID
  public function get($table, $id){
    try {
      $stmt = 
        $this
        ->conn
        ->prepare("SELECT * FROM $table WHERE id = $id");

      $stmt->execute();
      $results = $stmt->fetch(PDO::FETCH_ASSOC);
      return $results;
    } catch(PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }

  #- Fetch all record in table by specific params
  public function get_by($table, $param1, $param2){
    try {
      $stmt = 
        $this
        ->conn
        ->prepare("SELECT * FROM $table WHERE $param1 = $param2 ORDER BY id DESC");

      $stmt->execute();
      $results = $stmt->fetch(PDO::FETCH_ASSOC);
      return $results;
    } catch(PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }

  #- Select one record
  public function one($query){
    try {
      $stmt = 
        $this
        ->conn
        ->prepare($query);
      $stmt->execute();
      $results = $stmt->fetch(PDO::FETCH_ASSOC);
      return $results;
    } catch(PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }

  #- Select for universal
  public function all($query){
    try {
      $stmt = 
        $this
        ->conn
        ->prepare($query);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch(PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }

  #- update with specific
  public function update($table, $params, $id){
    try {
      $sql = "UPDATE $table SET $params WHERE id = $id";
      $stmt = 
        $this
        ->conn
        ->prepare($sql);
      $stmt->execute();
      $return = $this->get($table, $id);
      return $return;
    } catch(PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }

  public function insert($table, $col, $val){
    try {
      $sql = "INSERT INTO $table ($col) VALUES ($val)";
      $stmt =
        $this
        ->conn
        ->prepare($sql);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }

  public function delete($table, $id){
    try {
      $sql = "DELETE FROM $table WHERE id = $id";
      $stmt =
        $this
        ->conn
        ->prepare($sql);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return $e->getMessage();
    }
    $this->conn = null;
  }



}