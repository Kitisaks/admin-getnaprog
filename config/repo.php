<?php
class Repo {
  
  private $conn;

  function __construct(){
    $this->conn = null;

    try {
      $this->conn = new PDO("mysql:host=".DB["HOST"].";dbname=".DB["NAME"], DB["USER"], DB["PASSWORD"]);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  #- Fetch all record in table by ID
  public function get_by($table, $id){
    $stmt = 
      $conn->prepare(
        "SELECT * FROM $table WHERE id = $id"
      );
    $stmt->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($results);
  }

}