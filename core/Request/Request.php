<?php

namespace Core\Request;

use Core\Router\Router;

class Request
{
    private $type;
    private $controller;
    private $action;
    private $parametters = null;

    public function __construct($url = null)
    {
        $this->type = $_SERVER['REQUEST_METHOD'];

        $router = new Router();

        $routes = $router->getRoutes();
        if ($router->match($url)) {
            // Personal Rooting : 
            $matched_route = $router->match($url);
            $this->controler = $matched_route['controller'];
            $this->action = $matched_route['action'];

            //@TODO : Get parameters 
        } else {
            // Normal Routing
            $url_cleaned = trim($url, '/');

            $url_exploded = explode('/', $url_cleaned);
            switch (count($url_exploded)) {
                case 1:
                    $this->controller = $url_exploded[0];
                    $this->action = 'index';
                    break;
                case 2:
                    $this->controller = $url_exploded[0];
                    $this->action = $url_exploded[1];
                    break;
                case 3:
                    break;
                default:
                    break;
            }
        }
    }

    public function getParameters()
    {
        return $this->parametters;
    }
}
