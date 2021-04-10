<?php

namespace App\Router;

class Router
{

    private $routes = [
        '/' => ['controller' => 'Pages', 'action' => 'home']
    ];

    public function getRoutes()
    {
        return $this->routes;
    }
}
