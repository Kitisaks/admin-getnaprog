<?php

class Users extends Repo{

  #- create field to query
  // public $username;
  // public $password;
  // public $email;
  // public $role;
  // public $ip;

  function __construct(){
    parent::__construct();
    $this->table = strtolower(get_class($this));
  }

}

