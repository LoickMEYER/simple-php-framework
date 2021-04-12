<?php

namespace Core\Request;

use Core\Router\Router;
use Core\Utils\Tools;

class Request
{
    private $method;
    private $controller;
    private $action;
    private $parametters = [];

    public function __construct($url = null)
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        $router = new Router();
        $routes = $router->getRoutes();
        if ($router->match($url)) {
            // Personal Rooting : 
            $matched_route = $router->match($url);
            $this->controller = $matched_route['controller'];
            $this->action = $matched_route['action'];
            // We save parametters 
            if (!empty($matched_route['params_position'])) {
                $url_exploded = explode('/', trim($url, '/'));
                foreach ($matched_route['params_position'] as $param_position) {
                    $this->parametters[] = $url_exploded[$param_position];
                }
            }
            // Normal Routing
        } else {

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
                    $this->controller = $url_exploded[0];
                    $this->action = $url_exploded[1];

                    // We save the parametter
                    $this->parametters[] = $url_exploded[2];
                    break;
                default:
                    /**
                     * We have the default routing system (/controller/action/param) But we have several parameters : 
                     */
                    $this->controller = $url_exploded[0];
                    $this->action = $url_exploded[1];

                    // We save parametters : 
                    for ($i = 2; $i < count($url_exploded); $i++) {
                        if (!empty($url_exploded[$i])) {
                            $this->parametters[] = $url_exploded[$i];
                        }
                    }
                    break;
            }
        }
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getController($formated = true)
    {
        return ($formated) ? Tools::dashesToCamelCase($this->controller, true) : $this->controller;
    }

    public function getAction($formated = true)
    {
        return ($formated) ? Tools::dashesToCamelCase($this->action, false) : $this->action;
    }

    public function getParameters()
    {
        return $this->parametters;
    }

    /**
     * Return if the method(s) passed in parameters match to the request's method
     *
     * @param [type] $method The type can be "string" or "array" ⚠ Must be in upper case ! ⚠
     * @return boolean
     */
    public function is($method): bool
    {
        return (is_array($method)) ? (in_array($this->method, $method)) : ($this->method == $method);
    }

    public function getData(string $key = null)
    {
        return ($key) ? ((isset($_POST[$key])) ? $_POST[$key] : []) : $_POST;
    }


    public function render(): void
    {
        $controller_name = $this->getController(true);
        $controller_name_with_namespace = "App\\Controller\\" . $controller_name . 'Controller';
        $callable_controller = new $controller_name_with_namespace($this);

        $action_name = $this->getAction(true);

        $callable_controller->$action_name(...$this->parametters);

        // I) Render variables
        $variables = $callable_controller->getVariables();
        foreach ($variables as $variable_name => $variable_value) {
            // The "$$" wasn't a error.
            $$variable_name = $variable_value;
        }

        // II) View
        // $__content__ = file_get_contents(VIEW_DIR .  $controller_name . DS . $action_name . '.php'); // => Alternative
        ob_start();
        include VIEW_DIR .  $controller_name . DS . $action_name . '.php';
        $__content__ = ob_get_contents();
        ob_end_clean();

        // III) Layout
        include LAYOUT_DIR . $callable_controller->getLayout(true);
    }
}
