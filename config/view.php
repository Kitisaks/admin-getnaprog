<?php
#- use to render view.
class View
{
  function __construct(){
    $this->repo = new Repo();
    $this->get_current_user();
  }

  private function current_user()
  {
    if (isset($_SESSION["current_user"])) {
      return json_decode($_SESSION["current_user"]);
    } else {
      return null;
    }
  }

  public function get_current_user()
  {
    $GLOBALS["current_user"] = $this->current_user();
    $GLOBALS["users"] =
      $this
      ->repo
      ->all("SELECT username, status, role FROM users ORDER BY status DESC, role ASC, username ASC");
  }
  
  public function render($main, $page, $no_layout = false)
  {
    #- no layout set ($no_layout = 1)
    switch ($no_layout) {
      case true:
        require "../templates/layout/header.html.php";
        require "../templates/$main/$page.html.php";
        require "../templates/layout/bottom.html.php";
        break;

      case false:
        Utils::check_current_user();
        require "../templates/layout/header.html.php";
        require "../templates/layout/_popup.html.php";
        require "../templates/layout/_alert.html.php";
        require "../templates/layout/_navbar.html.php";
        require "../templates/$main/$page.html.php";  
        require "../templates/layout/_footer.html.php";
        require "../templates/layout/bottom.html.php";
        break;
    }
  }

  public function render_many($main, $pages, $no_layout = false)
  {
    switch ($no_layout) {
      case true:
        require "../templates/layout/header.html.php";
        foreach ($pages as $page) {
          require "../templates/$main/$page.html.php";
        }
        require "../templates/layout/bottom.html.php";
        break;

      case false:
        // $this->utils->messenger();
        require "../templates/layout/header.html.php";
        require "../templates/layout/_popup.html.php";
        require "../templates/layout/_alert.html.php";
        // require "../templates/layout/_messenger.html.php";
        require "../templates/layout/_navbar.html.php";
        foreach ($pages as $page) {
          require "../templates/$main/$page.html.php";
        }
        require "../templates/layout/_footer.html.php";
        require "../templates/layout/bottom.html.php";
        break;
    }
  }

  public static function partial($main, $pages)
  {
    if (is_array($pages)) {
      foreach ($pages as $page) {
        require "../templates/$main/$page.html.php";
      }
    } else {
      require "../templates/$main/$pages.html.php";
    }
  }
}
