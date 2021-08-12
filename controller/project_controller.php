<?php
class ProjectController
{
  function __construct()
  {
    $this->repo = new Repo();
  }

  public function create()
  {
    $ftp = Utils::ftp_init();
    var_dump($ftp->help());
  }
}
