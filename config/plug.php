<?php
class Plug
{

  function __construct()
  {
    $this->view = new View();
    $this->repo = new Repo();
    $this->conn();
  }

  public function loadmodule($main)
  {
    $path = $_SERVER["DOCUMENT_ROOT"] . "/controller/" . $main . "_controller.php";

    if (file_exists($path)) {
      require_once $path;
      $name = $main . "controller";
      $this->controller = new $name;
    }
  }

  public function conn()
  {
    $GLOBALS["conn"] = [
      "current_user" => $this->current_user(),
      "agency" => $this->current_agency()
    ];
  }

  private function current_user()
  {
    if (isset($_SESSION["current_user"])) {
      return json_decode($_SESSION["current_user"], true);
    } else {
      return null;
    }
  }

  private function current_agency()
  {
    if (isset($_SESSION["current_user"])) {
      $user = $this->current_user();
      return
        $this
        ->repo
        ->get("agencies", $user["agency_id"]);
    } else {
      return null;
    }
  }

  public function authenticate()
  {
    if (empty($_SESSION["current_user"])) {
      header("location: /auth");
      exit;
    }
  }


}
