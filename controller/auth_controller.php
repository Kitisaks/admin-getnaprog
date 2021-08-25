<?php
class AuthController
{
  function __construct()
  {
    $this->plug = new Plug();
    $this->repo = new Repo();
    if (isset($_SESSION["conn"])) {
      header("location: /home");
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
            ->select("*")
            ->from("users")
            ->where("(username = '{$user_mail}' || email = '{$user_mail}') && password = '{$password}'")
            ->one();

          switch ($results) {
            case false:
              $_SESSION["errno"] = [
                "status" => 0,
                "message" => "Username or password incorrect!"
              ];
              header("location: /auth");
              break;

            case true:
              $this
                ->plug
                ->assign_conn($results);

              header("location: /home");
              break;
          }
        } catch (PDOException $e) {
          exit("Error: " . $e->getMessage());
        }
      } else {
        header($_SERVER["SERVER_PROTOCOL"] . "405 Method Not Allowed");
        exit;
      }
    }
  }

  public function signup()
  {
    $agencies =
      $this
      ->repo
      ->select(["cname", "uuid"])
      ->from("agencies")
      ->order_by(["ASC" => "cname"])
      ->all();
    $GLOBALS["agencies"] = $agencies;
  }

  public function create()
  {
    if (!empty($_POST['token'])) {
      if (hash_equals($_SESSION['token'], $_POST['token'])) {
        $e = $this->check($_POST["username"], $_POST["email"]);
        switch ($e) {
          case true:
            $_SESSION["errno"] = [
              "status" => 0,
              "message" => "Username or email already taken!"
            ];
            header("location: /auth/signup");
            break;
          case false:
            $this->init_register();
            break;
        }
      } else {
        header($_SERVER["SERVER_PROTOCOL"] . "405 Method Not Allowed");
        exit;
      }
    }
  }

  #- check exist user in db
  private function check($username, $email)
  {
    $check =
      $this
      ->repo
      ->select(["username", "email"])
      ->from("users")
      ->where("username = '{$username}' || email = '{$email}'")
      ->one();
    return $check;
  }

  #- start to register the form
  private function init_register()
  {
    try {
      $agency_id =
        $this
        ->repo
        ->select("id")
        ->from("agencies")
        ->where("uuid = '{$_POST['agency_id']}'")
        ->one();

      $user = [
        "agency_id" => intval($agency_id["id"]),
        "name" => trim($_POST["name"]),
        "username" => trim(strtolower($_POST["username"])),
        "password" => md5(trim($_POST["password"])),
        "email" => trim(strtolower($_POST["email"])),
        "gender" => trim($_POST["gender"]),
        "phone" => trim($_POST["phone"]),
        "ip" => trim($_POST["ip"]),
        "uuid" => GenUuid::uuid6()
      ];

      if ($this->repo->insert("users", $user)) {
        $_SESSION["popup"] = ["status" => 1, "info" => "Already created your account."];
        header("location: /auth");
      } else {
        $_SESSION["popup"] = ["status" => 0, "error" => "Somethings went wrong."];
        header("location: /auth/signup");
      }
    } catch (PDOException $e) {
      exit("Error: " . $e->getMessage());
    }
  }

  public function logout()
  {
    session_destroy();
    header("location: /auth");
    exit;
  }

  public function reset()
  {
    if (!empty($_POST['token'])) {
      if (hash_equals($_SESSION['token'], $_POST['token'])) {
      } else {
        header($_SERVER["SERVER_PROTOCOL"] . "405 Method Not Allowed");
        exit;
      }
    }
  }
}
