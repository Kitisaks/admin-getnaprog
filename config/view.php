<?php
#- use to render view.
class View
{
  private $main;
  private $layout;
  private $path;

  function __construct($main)
  {
    $this->main = str_replace("controller", "", strtolower($main));
    $this->layout = true;
    $this->path = $_SERVER["DOCUMENT_ROOT"];
  }

  private function require($page, $folder = "layout")
  {
    require_once $this->path . "/templates/{$folder}/{$page}.php";
  }

  public function render($pages)
  {
    if ($this->layout) {
      if (is_string($pages)) {
        $this->require("header.html");
        $this->require("_alert.html");
        $this->require("_notice.html");
        $this->require("_popup.html");
        $this->require("_navbar.html");
        $this->require($pages, $this->main);
        $this->require("_footer.html");
        $this->require("bottom.html");
      } else if (is_array($pages)) {
        $this->require("header.html");
        $this->require("_alert.html");
        $this->require("_notice.html");
        $this->require("_popup.html");
        $this->require("_navbar.html");
        foreach ($pages as $page) {
          $this->require($page, $this->main);
        }
        $this->require("_footer.html");
        $this->require("bottom.html");
      }
    } else {
      if (is_string($pages)) {
        $this->require("header.html");
        $this->require("_alert.html");
        $this->require("_notice.html");
        $this->require("_popup.html");
        $this->require($pages, $this->main);
        $this->require("bottom.html");
      } else if (is_array($pages)) {
        $this->require("header.html");
        $this->require("_alert.html");
        $this->require("_notice.html");
        $this->require("_popup.html");
        foreach ($pages as $page) {
          $this->require($page, $this->main);
        }
        $this->require("bottom.html");
      }
    }
  }

  public static function partial($main, $pages)
  {
    $path = $_SERVER["DOCUMENT_ROOT"];
    if (is_array($pages)) {
      foreach ($pages as $page) {
        require_once $path . "/templates/{$main}/{$page}.php";
      }
    } else {
      require_once $path . "/templates/{$main}/{$pages}.php";
    }
  }

  public function put_layout(bool $layout)
  {
    $this->layout = $layout;
    return $this;
  }

  public function assign($param, $value = null)
  {
    if (!is_null($value))
      $GLOBALS[$param] = $value;
    return $this;
  }

  public function put_flash($status = true, $value)
  {
    if ($status)
      $_SESSION["popup"] = ["status" => 1, "info" => $value];
    else 
      $_SESSION["popup"] = ["status" => 0, "info" => $value];
    return $this;
  }

  public function redirect($uri)
  {
    header("location: {$uri}");
    exit;
  }

  public function return(string $type = "default", array $data)
  {
    switch ($type) {
      case "default":
        print_r(
          $data
        );
        break;
      case "json":
        print_r(
          json_encode($data)
        );
        break;
    }

  }
}
