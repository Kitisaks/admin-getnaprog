<?php
class ProjectController
{
  function __construct()
  {
    $this->repo = new Repo();
  }

  public function create()
  {
    echo "post<br>";
    foreach ($_POST as $p){
      var_export($p);
      echo "<br>";
    }
    echo "files<br>";
    foreach ($_FILES as $k){
      var_export($k);
      echo "<br>";
    }
  }
}
