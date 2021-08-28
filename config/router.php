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
    $this->route("/project/:uuid", ProjectView::class, "show");
    $this->route("/project/add/new", ProjectView::class, "new");
    $this->route("/project/add/create", ProjectView::class, "create");

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

    if ($request === $target) {
      return true;
    } else {
      $check = 0;
      if (count($request) === count($target)) {
        $sets = array_combine($target, $request);
        foreach ($sets as $key => $value) {
          if ($pos = strpos($key, ":") !== false) {
            $key = substr($key, $pos);
            $_REQUEST[$key] = $value;
            $check += 1;
          } else if ($key === $value) {
            $check += 1;
          }
        }
      }
      if ($check === count($request)) {
        return true;
      } else {
        return false;
      }
    }
  }

  private function parse_uri($uri)
  {
    return explode("/", trim($uri, "/"));
  }

  /**
   * To Create * Do Not * add /example/:id and /example/test like this!
   * It will route to first item that found in this by top to bot
   */
  private function route(string $uri,string $view,string $template)
  {
    if ($this->set_param($uri)) {
      $this->endpoint($view, $template);
    } else if ($uri === "/error") {
      $this->endpoint($view, $template);
    } else {
      return null;
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
