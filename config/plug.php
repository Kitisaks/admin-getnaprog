<?php
class Plug
{
  function __construct()
  {
    $this->view = new View();
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
    $repo = new Repo();
    return
      $repo
      ->get("agencies", $current_user["agency_id"]);
  }

  protected function call($call)
  {
    return strtolower(str_replace("View", "", $call));
  }

  protected function permitted()
  {
    if (empty($_SESSION["conn"])) {
      header("location: /auth");
      exit;
    }
  }

  protected function alived()
  {
    if (isset($_SESSION["conn"])) {
      header("location: /home");
      exit;
    }
  }
}
