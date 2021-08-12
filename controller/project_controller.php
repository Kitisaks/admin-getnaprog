<?php
class ProjectController
{
  function __construct()
  {
    $this->repo = new Repo();
  }

  public function create()
  {
    echo Utils::ftp_init();
  }
}