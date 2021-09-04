<?php

class AuthController
{
  function __construct()
  {
    $this->view = new View(__CLASS__);
    $this->repo = new Repo();
  }

  public function index($conn, $params)
  {
    Plug::alived();
    $agencies =
      $this
      ->repo
      ->select(["cname", "uuid"])
      ->from("agencies")
      ->order_by(["asc" => "cname"])
      ->all();

    $this
    ->view
    ->assign("agencies", $agencies)
    ->put_layout(false)
    ->render("index.html");
  }

  #- login
  public function login($conn, $params)
  {
    $user_mail = strtolower(trim($params["user_mail"]));
    $password = md5(trim($params["password"]));

    $agency =
      $this
      ->repo
      ->select("id")
      ->from("agencies")
      ->where("uuid = '{$params['agency_uuid']}'")
      ->one();

    $user =
      $this
      ->repo
      ->from("users")
      ->where("(username = '{$user_mail}' or email = '{$user_mail}') and password = '{$password}' and agency_id = {$agency['id']}")
      ->one();

    if (empty($user)) {
      $this
      ->view
      ->put_flash(false, "Your username or password is incorrect!")
      ->redirect("/auth");
    } else {
      Plug::assign_conn($user);
      $this
      ->view
      ->put_flash(true, "Welcome back {$user['name']}!")
      ->redirect("/home");
    }
  }

  public function signup($conn, $params)
  {
    $agencies =
      $this
      ->repo
      ->select(["cname", "uuid"])
      ->from("agencies")
      ->order_by(["asc" => "cname"])
      ->all();
    
    $this
    ->view
    ->assign("agencies", $agencies)
    ->put_layout(false)
    ->render("signup.html");
  }

  public function create($conn, $params)
  {
    $e = $this->check($_POST["username"], $_POST["email"]);
    switch ($e) {
      case true:
        $this
        ->view
        ->put_flash(false, "Username or email already taken!")
        ->redirect("/auth/signup");
        
      case false:
        $this->init_register($params);
        break;
    }
  }

  #- check exist user in db
  private function check($username, $email)
  {
    return 
      $this
      ->repo
      ->select(["username", "email"])
      ->from("users")
      ->where("username = '{$username}' or email = '{$email}'")
      ->one();
  }

  #- start to register the form
  private function init_register($params)
  {
    $agency =
      $this
      ->repo
      ->select("id")
      ->from("agencies")
      ->where("uuid = '{$params['agency_id']}'")
      ->one();

    $user = [
      "agency_id" => $agency["id"],
      "name" => trim($params["name"]),
      "username" => strtolower(trim($params["username"])),
      "password" => md5(trim($params["password"])),
      "email" => strtolower(trim($params["email"])),
      "gender" => trim($params["gender"]),
      "phone" => trim($params["phone"]),
      "ip" => trim($params["ip"]),
      "uuid" => GenUuid::uuid6()
    ];

    if ($this->repo->insert("users", $user)) {
      $this
      ->view
      ->put_flash(true, "Already created your account.")
      ->redirect("/auth");
    } else {
      $this
      ->view
      ->put_flash(false, "Somethings went wrong.")
      ->redirect("/auth/signup");
    }
  }

  public function signout($conn, $params)
  {
    if (session_unset())
      if (session_destroy())
        $this->view->redirect("/auth");
  }

  public function reset($conn, $params)
  {
    exit("reset");
  }
}
