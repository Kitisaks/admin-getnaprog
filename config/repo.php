<?php
class Repo extends PDO{
  
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
  public function get_by($table, $id){
    $stmt = 
      $this
      ->conn
      ->prepare("SELECT * FROM $table WHERE id = :id");

    $stmt->execute(array(":id" => $id));
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
  }

  #- Fetch all record in table by ID
  public function all($query){
    $stmt = 
      $this
      ->conn
      ->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

}