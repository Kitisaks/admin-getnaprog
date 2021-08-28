<?php
final class Router
{
  function __construct($uri = "/")
  {
    // exit($uri);
    switch ($uri) {
      case "/": $this->route(AuthView::class, "index"); break;
      #- /auth
      case "/auth": $this->route(AuthView::class, "index"); break;
      case "/auth/login": $this->route(AuthView::class, "login"); break;
      case "/auth/signup": $this->route(AuthView::class, "signup"); break;
      case "/auth/signout": $this->route(AuthView::class, "signout"); break;
      case "/auth/reset": $this->route(AuthView::class, "reset"); break;
      case "/auth/add": $this->route(AuthView::class, "add"); break;

      #- /home
      case "/home": $this->route(HomeView::class, "index"); break;

      #- /project
      case "/project": $this->route(ProjectView::class, "index"); break;
      case "/project/:id": $this->route(ProjectView::class, "index"); break;
      case "/project/new": $this->route(ProjectView::class, "new"); break;
      case "/project/create": $this->route(ProjectView::class, "create"); break;

      #- /tools
      case "/tools": $this->route(ToolsView::class, "index"); break;
      case "/tools/genuuid": $this->route(ToolsView::class, "genuuid"); break;

      
      default: $this->route(NotfoundView::class, "index"); break;
    }
  }

  private function route($view, $template)
  {
    $file = $_SERVER["DOCUMENT_ROOT"] . "/view/" . str_replace("view", "", strtolower($view)) . "_view.php";
    require_once $file;
    $classview = new $view;
    #- Load Controller
    $this->loadcontroller($classview, $view);
    #- Load View
    $this->loadview($classview, $template);
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
