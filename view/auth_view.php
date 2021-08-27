<?php

class AuthView extends Plug
{

  function __construct()
  {
    parent::__construct();
    $this->main = $this->call(__CLASS__);
  }

  public function index()
  {
    #- If exist old session, redirect to /home
    $this->alived();

    $this
      ->view
      ->layout(false)
      ->render($this->main, "index");
  }

  public function login()
  {
    $this
      ->controller
      ->login();
  }

  public function reset()
  {
    $this
      ->controller
      ->reset();

    $this
      ->view
      ->layout(false)
      ->render($this->main, "reset");
  }

  public function signup()
  {
    $this
      ->controller
      ->signup();
      
    $this
      ->view
      ->layout(false)
      ->render($this->main, "signup");
  }

  public function add()
  {
    $this
      ->controller
      ->create();
  }

  public function signout()
  {
    $this
      ->controller
      ->signout();
  }
}
