<?php

namespace App\Controller;

use App\{Repo,View,Session,Data}; 

class AuthController
{
  public function __construct()
  {
    $this->View = new View(__CLASS__);
    $this->Repo = new Repo();

    $this->DataUser = new Data\User;
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
      ->Repo
      ->select(["cname", "uuid"])
      ->from("agencies")
      ->order_by(["asc" => "cname"])
      ->all();

    $this
      ->View
      ->assign("agencies", $agencies)
      ->put_layout(false)
      ->render("index.html");
  }

  #- login
  public function login($_, $params)
  {
    $user_mail = strtolower(trim($params["user_mail"]));
    $password = hash_hmac("sha256", trim($params["password"]), PEPPER_KEY);

    $agency =
      $this
      ->Repo
      ->from("agencies")
      ->where("uuid = '{$params['agency_uuid']}'")
      ->one();

    $user =
      $this
      ->Repo
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
      ->View
      ->put_flash(false, "Your username or password is incorrect!")
      ->redirect("/auth");
  }

  private function _allowed($user, $agency)
  {
    Session::assign_conn($user, $agency);
    $this
      ->View
      ->put_flash(true, "Welcome back {$user['name']}!")
      ->redirect("/content");
  }

  public function signup()
  {
    $agencies =
      $this
      ->Repo
      ->select(["cname", "uuid"])
      ->from("agencies")
      ->order_by(["asc" => "cname"])
      ->all();

    $this
      ->View
      ->assign("agencies", $agencies)
      ->put_layout(false)
      ->render("signup.html");
  }

  public function create($_, $params)
  {
    $user =       
      $this
      ->Repo
      ->select(["username", "email"])
      ->from("users")
      ->where("username = '{$_POST['username']}' or email = '{$_POST['email']}'")
      ->one();

    switch ($user) {
      case null:
        if ($this->DataUser->create($params)) {
          $this
            ->View
            ->put_flash(true, "Already created your account.")
            ->redirect("/auth");
        } else {
          $this
            ->View
            ->put_flash(false, "Somethings went wrong.")
            ->redirect("/auth/signup");
        }
        break;

      case $user:
        $this
          ->View
          ->put_flash(false, "Username or email already taken!")
          ->redirect("/auth/signup");
        break;
    }
  }

  public function signout()
  {
    if (session_unset())
      if (session_destroy())
        $this->View->redirect("/auth");
  }

  public function reset()
  {
    exit("reset");
  }
}
