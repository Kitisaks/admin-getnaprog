<?php

class Auth extends Plug
{

  function __construct()
  {
    parent::__construct();
    $this->main = strtolower(get_class($this));
  }

  public function index()
  {
    $this
      ->view
      ->render($this->main, "index", 1);
  }

  public function login()
  {
    $this
      ->controller
      ->login();
  }

  public function forg_pwsd()
  {
    $this
      ->controller
      ->forg_pswd();

    $this
      ->view
      ->render($this->main, "forg_pswd", 1);
  }

  public function signup()
  {
    $this
      ->view
      ->render($this->main, "signup", 1);
  }

  public function add()
  {
    $this
      ->controller
      ->register();
  }

  public function logout()
  {
    $this
      ->controller
      ->logout();
  }
}
