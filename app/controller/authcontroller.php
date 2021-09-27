<?php

namespace App\Controller;

use 
  App\Plug, 
  App\View, 
  App\Session,
  App\Libs;

class AuthController extends Plug
{
  public function __construct()
  {
    parent::__construct();
    $this->view = new View(__CLASS__);
  }

  public function redirect()
  {
    Session::alived();
    Session::permitted();
  }

  public function index()
  {
    Session::alived();
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
      ->from("agencies")
      ->where("uuid = '{$params['agency_uuid']}'")
      ->one();

    $user =
      $this
      ->repo
      ->from("users")
      ->where("(username = '{$user_mail}' or email = '{$user_mail}') and password = '{$password}'")
      ->one();

    if (empty($user)) {
      $this->_disallowed();
    } else {
      if ($user["role"] < 4) {
        if ($user["agency_id"] === $agency["id"])
          $this->_allowed($user, $agency);
        else
          $this->_disallowed();
      } else {
        $this->_allowed($user, $agency);
      }
    }
  }

  private function _disallowed()
  {
    $this
      ->view
      ->put_flash(false, "Your username or password is incorrect!")
      ->redirect("/auth");
  }

  private function _allowed($user, $agency)
  {
    Session::assign_conn($user, $agency);
    $this
      ->view
      ->put_flash(true, "Welcome back {$user['name']}!")
      ->redirect("/content");
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
    $e = $this->_check($_POST["username"], $_POST["email"]);
    switch ($e) {
      case true:
        $this
          ->view
          ->put_flash(false, "Username or email already taken!")
          ->redirect("/auth/signup");

      case false:
        $this->_init_register($params);
        break;
    }
  }

  #- check exist user in db
  private function _check($username, $email)
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
  private function _init_register($params)
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
      "uuid" => Libs\GenUuid::uuid6()
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
