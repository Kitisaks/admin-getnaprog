<?php
class AuthController extends Repo{
  
  function __construct(){
    parent::__construct();
  }

  #- login
  public function login(){
    if (!empty($_POST['token'])) {
      if (hash_equals($_SESSION['token'], $_POST['token'])) {
        try {
          $stmt = 
          $this
          ->conn
          ->prepare("SELECT * FROM users WHERE (email = :email OR username = :username) AND password = :password");
  
          $stmt
          ->execute(
            array(
              ":email" => $_POST["username_email"],
              ":username" => $_POST["username_email"],
              ":password" => md5($_POST["password"])
            )
          );

          $results = $stmt->fetch(PDO::FETCH_ASSOC);
          switch ($results){
            case false:
              header("location: /auth");
              break;
            
            default:
              $results = json_encode($results);
              $_SESSION["current_user"] = $results;
              header("location: /main");
              break;
          }
        } catch (PDOException $e) {
          echo $stmt . "<br>" . $e->getMessage();
        }
      } else {
        header("location: /notfound");
      }
    }
  }
  
  #- check exist user in db
  private function check_user($username){
    $repo = new Repo();
    $check = $repo->all("SELECT username FROM users WHERE username = '$username'");
    return $check;
  }

  #- start to register the form
  private function init_register(){
    try {
      $stmt = 
        $this
        ->conn
        ->prepare(
          "INSERT INTO users 
          (name, username, password, email, ip) 
          VALUES (:name, :username, :password, :email, :ip)"
        );

      $stmt
      ->execute(
        array(
          ":name" => $_POST["name"],
          ":username" => $_POST["username"],
          ":password" => md5($_POST["password"]),
          ":email" => $_POST["email"],
          ":ip" => $_POST["ip"]
        )
      );
      header("location: /auth");
    } catch (PDOException $e) {
      echo $stmt . "<br>" . $e->getMessage();
    }
  }

  #- recieve post method action
  public function register(){
    if (!empty($_POST['token'])) {
      if (hash_equals($_SESSION['token'], $_POST['token'])) {
        $e = $this->check_user($_POST["username"]);
        
        switch ($e) {
          case true:
            header("location: /auth/register");
            break;
          
          case false:
            $this->init_register();
            break;
        }
      } else {
        header("location: /notfound");
      }
    }

  }

}
