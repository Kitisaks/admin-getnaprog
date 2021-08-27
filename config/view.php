<?php
#- use to render view.
class View
{
  private $layout = true;

  public function layout(bool $layout)
  {
    $this->layout = $layout;
    return $this;
  }

  public function render($main, $page)
  {
    switch ($this->layout) {
      case false:
        require "../templates/layout/header.html.php";
        require "../templates/layout/_popup.html.php";
        require "../templates/{$main}/{$page}.html.php";
        require "../templates/layout/bottom.html.php";
        break;

      case true:
        require "../templates/layout/header.html.php";
        require "../templates/layout/_popup.html.php";
        require "../templates/layout/_navbar.html.php";
        require "../templates/{$main}/{$page}.html.php";
        require "../templates/layout/_footer.html.php";
        require "../templates/layout/bottom.html.php";
        break;
    }
  }

  public function render_many($main, array $pages)
  {
    switch ($this->layout) {
      case false:
        require "../templates/layout/header.html.php";
        require "../templates/layout/_popup.html.php";
        foreach ($pages as $page) {
          require "../templates/{$main}/{$page}.html.php";
        }
        require "../templates/layout/bottom.html.php";
        break;

      case true:
        require "../templates/layout/header.html.php";
        require "../templates/layout/_popup.html.php";
        require "../templates/layout/_navbar.html.php";
        foreach ($pages as $page) {
          require "../templates/{$main}/{$page}.html.php";
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
        require "../templates/{$main}/{$page}.html.php";
      }
    } else {
      require "../templates/{$main}/{$pages}.html.php";
    }
  }
}
