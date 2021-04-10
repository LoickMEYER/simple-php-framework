<?php

namespace Core\Router;

class Route
{
    private $path;
    private $controller;
    private $action;
    private $params;

    public function __construct($path, $controller, $action, $params = null)
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->action = $action;
    }
}
