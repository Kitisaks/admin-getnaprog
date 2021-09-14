<?php
namespace App;

use App\Libs\Route;
use App\Controller;

final class Router
{
  function __construct()
  {
    new Route('GET', '/', Controller\AuthController::class, 'index');
    
    #- /auth
    new Route('GET', '/auth', Controller\AuthController::class, 'index');
    new Route('POST', '/auth/login', Controller\AuthController::class, 'login');
    new Route('GET', '/auth/signup', Controller\AuthController::class, 'signup');
    new Route('GET', '/auth/signout', Controller\AuthController::class, 'signout');
    new Route('POST', '/auth/reset', Controller\AuthController::class, 'reset');
    new Route('POST', '/auth/add', Controller\AuthController::class, 'create');
    
    #- /home
    new Route('GET', '/home', Controller\HomeController::class, 'index');

    #- /project
    new Route('GET', '/project', Controller\ProjectController::class, 'index');
    new Route('GET', '/project/new', Controller\ProjectController::class, 'new');
    
    new Route('GET', '/project/:uuid', Controller\ProjectController::class, 'show');
    new Route('DELETE', '/project/:uuid', Controller\ProjectController::class, 'delete');
    new Route('POST', '/project/create', Controller\ProjectController::class, 'create');


    #- /design
    new Route('GET', '/design', Controller\DesignController::class, 'index');
    new Route('GET', '/design/:id', Controller\DesignController::class, 'show');
    new Route('DELETE', '/design/:id', Controller\DesignController::class, 'delete');
    new Route('PATCH', '/design/:id', Controller\DesignController::class, 'update');

    #- /tools
    new Route('GET', '/tools', Controller\ToolsController::class, 'index');
    new Route('GET', '/tools/genuuid', Controller\ToolsController::class, 'genuuid');


    #- Notfound
    new Route('GET', '/error', Controller\NotfoundController::class, 'index');
  }
}
