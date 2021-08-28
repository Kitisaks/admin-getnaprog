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
    $path = $_SERVER["DOCUMENT_ROOT"];
    switch ($this->layout) {
      case false:
        require $path . "/templates/layout/header.html.php";
        require $path . "/templates/layout/_popup.html.php";
        require $path . "/templates/{$main}/{$page}.html.php";
        require $path . "/templates/layout/bottom.html.php";
        break;

      case true:
        require $path . "/templates/layout/header.html.php";
        require $path . "/templates/layout/_popup.html.php";
        require $path . "/templates/layout/_navbar.html.php";
        require $path . "/templates/{$main}/{$page}.html.php";
        require $path . "/templates/layout/_footer.html.php";
        require $path . "/templates/layout/bottom.html.php";
        break;
    }
  }

  public function render_many($main, array $pages)
  {
    $path = $_SERVER["DOCUMENT_ROOT"];
    switch ($this->layout) {
      case false:
        require $path . "/templates/layout/header.html.php";
        require $path . "/templates/layout/_popup.html.php";
        foreach ($pages as $page) {
          require $path . "/templates/{$main}/{$page}.html.php";
        }
        require $path . "/templates/layout/bottom.html.php";
        break;

      case true:
        require $path . "/templates/layout/header.html.php";
        require $path . "/templates/layout/_popup.html.php";
        require $path . "/templates/layout/_navbar.html.php";
        foreach ($pages as $page) {
          require $path . "/templates/{$main}/{$page}.html.php";
        }
        require $path . "/templates/layout/_footer.html.php";
        require $path . "/templates/layout/bottom.html.php";
        break;
    }
  }

  public static function partial($main, $pages)
  {
    $path = $_SERVER["DOCUMENT_ROOT"];
    if (is_array($pages)) {
      foreach ($pages as $page) {
        require $path . "/templates/{$main}/{$page}.html.php";
      }
    } else {
      require $path . "/templates/{$main}/{$pages}.html.php";
    }
  }
}
