<?php

final class Router
{
  function __construct()
  {
    new Route("GET", "/", AuthController::class, "index");
    
    #- /auth
    new Route("GET", "/auth", AuthController::class, "index");
    new Route("POST", "/auth/login", AuthController::class, "login");
    new Route("GET", "/auth/signup", AuthController::class, "signup");
    new Route("GET", "/auth/signout", AuthController::class, "signout");
    new Route("POST", "/auth/reset", AuthController::class, "reset");
    new Route("POST", "/auth/add", AuthController::class, "create");
    
    #- /home
    new Route("GET", "/home", HomeController::class, "index");

    #- /project
    new Route("GET", "/project", ProjectController::class, "index");
    new Route("GET", "/project/new", ProjectController::class, "new");
    
    new Route("GET", "/project/:uuid", ProjectController::class, "show");
    new Route("POST", "/project/create", ProjectController::class, "create");


    #- /design
    new Route("GET", "/design", DesignController::class, "index");
    new Route("GET", "/design/:id", DesignController::class, "show");
    new Route("PATCH", "/design/:id", DesignController::class, "update");

    #- /tools
    new Route("GET", "/tools", ToolsController::class, "index");
    new Route("GET", "/tools/genuuid", ToolsController::class, "genuuid");


    #- Notfound
    new Route("GET", "/error", NotfoundController::class, "index");
  }
}
