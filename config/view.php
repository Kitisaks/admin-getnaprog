<?php
#- use to render view.
class View
{
  function __construct(){
    $this->utils = new Utils();
    $this->utils->get_current_user();
  }
  
  public function render($main, $page, $no_layout = false)
  {
    #- no layout set ($no_layout = 1)
    switch ($no_layout) {
      case true:
        require "../templates/layout/header.html.php";
        require "../templates/$main/$page.html.php";
        require "../templates/layout/footer.html.php";
        break;

      case false:
        Utils::check_current_user();
        // $this->utils->messenger();
        require "../templates/layout/header.html.php";
        require "../templates/layout/_popup.html.php";
        require "../templates/layout/_alert.html.php";
        // require "../templates/layout/_messenger.html.php";
        require "../templates/layout/_navbar.html.php";
        require "../templates/$main/$page.html.php";  
        require "../templates/layout/footer.html.php";
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
        require "../templates/layout/footer.html.php";
        break;

      case false:
        // $this->utils->messenger();
        require "../templates/layout/header.html.php";
        require "../templates/layout/_popup.html.php";
        require "../templates/layout/_alert.html.php";
        // require "../templates/layout/_messenger.html.php";
        require "../templates/layout/sidebar_top.html.php";
        foreach ($pages as $page) {
          require "../templates/$main/$page.html.php";
        }
        require "../templates/layout/sidebar_bot.html.php";
        require "../templates/layout/footer.html.php";
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
