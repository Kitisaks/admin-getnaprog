<?php

namespace App;

use App\Libs\Route;

// Add controllers here
use App\Controller\{
  PageController,
  ErrorController
};


final class Router
{
  public function __construct()
  {
    new Route('GET', '/', PageController::class, 'index');

    // Default routine after fallback
    new Route('GET', '/404', ErrorController::class, 'notfound_404');
  }
}
