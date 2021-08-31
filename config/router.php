<?php

final class Router
{
  private $uri;

  function __construct(string $uri = "/")
  {
    $this->uri = $uri;

    $this->route("/", AuthView::class, "index");
    #- /auth
    $this->route("/auth", AuthView::class, "index");
    $this->route("/auth/login", AuthView::class, "login");
    $this->route("/auth/signup", AuthView::class, "signup");
    $this->route("/auth/signout", AuthView::class, "signout");
    $this->route("/auth/reset", AuthView::class, "reset");
    $this->route("/auth/add", AuthView::class, "add");
    
    #- /home
    $this->route("/home", HomeView::class, "index");

    #- /project
    $this->route("/project", ProjectView::class, "index");
    $this->route("/project/new", ProjectView::class, "new");
    $this->route("/project/create", ProjectView::class, "create");
    $this->route("/project/:uuid", ProjectView::class, "show");

    #- /design
    $this->route("/design", DesignView::class, "index");

    #- /tools
    $this->route("/tools", ToolsView::class, "index");
    $this->route("/tools/genuuid", ToolsView::class, "genuuid");


    #- Notfound
    $this->route("/error", NotfoundView::class, "index");
  }

  private function set_param(string $target)
  {
    $request = $this->parse_uri($this->uri);
    $target = $this->parse_uri($target);

    #- Bypass this first
    if ($request === $target)
      return true;
    if (count($target) === count($request)) {
      $ck = 0;
      $num = count($request);
      for ($n = 0; $n < $num; $n++) {
        if ($request[$n] === $target[$n]) {
          $ck++;
          if ($ck === $num)
            return true;
        } else if ($ps = strpos($target[$n], ":") !== false) {
          $ck++;
          if ($ck === $num) {
            $_REQUEST[substr($target[$n], $ps)] = $request[$n];
            return true;
          }
        }
      }
    }
    return false;
  }

  private function parse_uri($uri)
  {
    return explode("/", trim($uri, "/"));
  }

  /**
   * To Create * Do Not * add /example/:id and /example/test like this!
   * It will route to first item that found in this by top to bot
   * Please reorder route like this 
   * /example/test1
   * /example/test2
   * /example/:id
   */
  private function route(string $uri, string $view, string $template): void
  {
    if ($this->set_param($uri)) {
      $this->endpoint($view, $template);
      exit;
    } else if ($uri === "/error") {
      $this->endpoint($view, $template);
      exit;
    }
  }

  private function endpoint($view, $template)
  {
    $file = $_SERVER["DOCUMENT_ROOT"] . "/view/" . str_replace("view", "", strtolower($view)) . "_view.php";
    require_once $file;
    $classview = new $view;
    #- Load Controller
    $this->loadcontroller($classview, $view);
    #- Load View
    $this->loadview($classview, $template);
    exit;
  }

  private function loadcontroller($classview, $view)
  {
    $class = str_replace("view", "", strtolower($view));
    $classview->loadmodule($class);
  }

  private function loadview($view, $template)
  {
    $view->$template();
    return $view;
  }
}
