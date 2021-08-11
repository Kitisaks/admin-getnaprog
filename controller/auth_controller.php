<?php
class AuthController
{

  function __construct()
  {
    $this->repo = new Repo();
    if (isset($_SESSION["current_user"])) {
      header("location: /main");
    }
  }

  #- login
  public function login()
  {
    if (!empty($_POST['token'])) {
      if (hash_equals($_SESSION['token'], $_POST['token'])) {
        $user_mail = trim(strtolower($_POST["user_mail"]));
        $password = md5(trim($_POST["password"]));
        try {
          $results =
            $this
            ->repo
            ->one("SELECT * FROM users WHERE (username = '$user_mail' OR email = '$user_mail') AND password = '$password'");

          switch ($results) {
            case false:
              $_SESSION["errno"] = array(
                "status" => 0,
                "message" => "Username or password incorrect!"
              );
              header("location: /auth");
              break;

            case true:
              $id = $results["id"];

              $current_user =
                $this
                ->repo
                ->update("users", "status = 1", $id);

              if ($current_user) {
                $_SESSION["current_user"] = json_encode($current_user);
                header("location: /home");
                return false;
              } else {
                header("location: /auth");
                return false;
              }
              break;
          }
        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      } else {
        header("location: /notfound");
      }
    }
  }

  #- recieve post method action
  public function register()
  {
    if (!empty($_POST['token'])) {
      if (hash_equals($_SESSION['token'], $_POST['token'])) {
        $e = $this->check($_POST["username"], $_POST["email"]);
        switch ($e) {
          case true:
            $_SESSION["errno"] =
              array(
                "status" => 0,
                "message" => "Username or email already taken!"
              );

            header("location: /auth/signup");
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

  #- check exist user in db
  private function check($username, $email)
  {
    $check =
      $this
      ->repo
      ->one("SELECT username, email FROM users WHERE username = '$username' OR email = '$email'");

    return $check;
  }

  #- start to register the form
  private function init_register()
  {
    try {
      $stmt =
        $this
        ->conn
        ->prepare(
          "INSERT INTO users 
          (name, username, password, email, gender, phone, ip) 
          VALUES (:name, :username, :password, :email, :gender, :phone, :ip)"
        );

      $stmt
        ->execute(
          array(
            ":name" => trim($_POST["name"]),
            ":username" => trim(strtolower($_POST["username"])),
            ":password" => md5(trim($_POST["password"])),
            ":email" => trim(strtolower($_POST["email"])),
            ":gender" => trim($_POST["gender"]),
            ":phone" => trim($_POST["phone"]),
            ":ip" => trim($_POST["ip"])
          )
        );
      header("location: /auth");
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function logout()
  {
    if (isset($_SESSION["current_user"])) {
      $user_id = json_decode($_SESSION["current_user"], true)["id"];
      $logout =
        $this
        ->repo
        ->update("users", "status = 0", $user_id);
      if ($logout) {
        session_destroy();
        header("location: /auth");
      } else {
        header("location: /home");
      }
    }
  }

  public function forg_pswd()
  {
    if (!empty($_POST['token'])) {
      if (hash_equals($_SESSION['token'], $_POST['token'])) {
      } else {
        header("location: /notfound");
      }
    }
  }
}
