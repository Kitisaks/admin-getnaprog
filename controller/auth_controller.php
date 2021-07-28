<?php
class AuthController extends Repo{
  
  function __construct(){
    parent::__construct();
  }

  public function login(){
    if (!empty($_POST['token'])) {
      if (hash_equals($_SESSION['token'], $_POST['token'])) {
        $stmt = 
          $this
          ->conn
          ->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
  
        $stmt
        ->execute(
          array(
            ":email" => $_POST["email"],
            ":password" => $_POST["password"]
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
      } else {
        header("location: /notfound");
      }
    }
  }

  public function logout(){

  }

}
