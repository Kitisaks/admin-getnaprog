<?php
class Plug
{

  function __construct()
  {
    $this->view = new View();
    $this->repo = new Repo();
  }

  public function loadmodule($main)
  {
    $path = $_SERVER["DOCUMENT_ROOT"] . "/controller/{$main}_controller.php";

    if (file_exists($path)) {
      require_once $path;
      $name = ucfirst($main) . "Controller";
      $this->controller = new $name;
    }
  }

  public function assign_conn($current_user)
  {
    $_SESSION["conn"]["current_user"] = $current_user;
    $_SESSION["conn"]["agency"] = $this->current_agency($current_user);
  }

  private function current_agency($current_user)
  {
    return
      $this
      ->repo
      ->get("agencies", $current_user["agency_id"]);
  }

  public function authenticate()
  {
    if (empty($_SESSION["conn"])) {
      header("location: /auth");
      exit;
    }
  }
}
