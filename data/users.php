<?php
require "../config/repo.php";

class Users{

  private $conn;
  private $table;

  #- create field to query
  public $username;
  public $password;
  public $email;
  public $role;
  public $ip;

  function __construct($db){
    $this->table = strtolower(get_class($this));
    $this->conn = $db;
  }

  #- To get all record from table

}

