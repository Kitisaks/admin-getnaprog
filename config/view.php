<?php
#- use to render view.
class View
{
  function __construct()
  {
    $this->layout = true;
    $this->path = $_SERVER["DOCUMENT_ROOT"];
  }

  public function layout(bool $layout)
  {
    $this->layout = $layout;
    return $this;
  }

  private function require($page, $folder = "layout")
  {
    require_once $this->path . "/templates/{$folder}/{$page}.html.php";
  }

  public function render($main, $pages)
  {
    if ($this->layout) {
      if (is_string($pages)) {
        $this->require("header");
        $this->require("_alert");
        $this->require("_notice");
        $this->require("_popup");
        $this->require("_navbar");
        $this->require($pages, $main);
        $this->require("_footer");
        $this->require("bottom");
      } else if (is_array($pages)) {
        $this->require("header");
        $this->require("_alert");
        $this->require("_notice");
        $this->require("_popup");
        $this->require("_navbar");
        foreach ($pages as $page) {
          $this->require($page, $main);
        }
        $this->require("_footer");
        $this->require("bottom");
      }
    } else {
      if (is_string($pages)) {
        $this->require("header");
        $this->require("_alert");
        $this->require("_notice");
        $this->require("_popup");
        $this->require($pages, $main);
        $this->require("bottom");
      } else if (is_array($pages)) {
        $this->require("header");
        $this->require("_alert");
        $this->require("_notice");
        $this->require("_popup");
        foreach ($pages as $page) {
          $this->require($page, $main);
        }
        $this->require("bottom");
      }
    }
  }

  public static function partial($main, $pages)
  {
    $path = $_SERVER["DOCUMENT_ROOT"];
    if (is_array($pages)) {
      foreach ($pages as $page) {
        require_once $path . "/templates/{$main}/{$page}.html.php";
      }
    } else {
      require_once $path . "/templates/{$main}/{$pages}.html.php";
    }
  }
}
