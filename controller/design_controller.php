<?php
class DesignController
{
  function __construct()
  {
    Plug::permitted();
    $this->view = new View(__CLASS__);
    $this->repo = new Repo();
  }

  public function index($conn, $params) 
  {
    $templates = 
      $this
      ->repo
      ->from("templates")
      ->where("agency_id = {$conn['agency']['id']}")
      ->group_by("permalink")
      ->all();

    $this
    ->view
    ->assign("templates", $templates)
    ->render("index.html");
  }


}