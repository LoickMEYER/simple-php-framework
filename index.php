<?php
require 'vendor/autoload.php';

require 'config/path.php';

use Core\Request\Request;
use Core\Router\Router;
use Core\Utils\Tools;

$url = $_GET['url'];

// UTILS / TOOLS
$tools = new Tools();

// ROUTING 
$router = new Router();
$routes = $router->getRoutes();

$request = new Request($url);
// We look for personal route : 
if (isset($routes[$url])) {
    // Personal Rooting : 
    $controler = $routes[$url]['controller'];
    $action = $routes[$url]['action'];
} else {
    // Normal Routing
    $url_cleaned = trim($url, '/');

    $url_exploded = explode('/', $url_cleaned);
    switch (count($url_exploded)) {
        case 1:
            $controler = $url_exploded[0];
            $action = 'index';
            $parametters = null;
            break;
        case 2:
            $controler = $url_exploded[0];
            $action = $url_exploded[1];
            $parametters = null;
            break;
        case 3:
            break;
        default:
            break;
    }
    // $controler = explode('/', $url_cleaned)[0];
    // $action = explode('/', $url_cleaned)[1];
    // $parametters = explode('/', $url_cleaned)[2];
}

// Call the controller 
$controler_name = $tools->dashesToCamelCase($controler, true);
$controler_name_with_namespace = "App\\Controller\\" . $controler_name . 'Controller';
$call_controller = new $controler_name_with_namespace();

// Call the action 
$action_name = $tools->dashesToCamelCase($action);
$call_controller->$action_name();


// Render the Layout & View

// I) Render variables
$variables = $call_controller->getVariables();
foreach ($variables as $variable_name => $variable_value) {
    // The "$$" wasn't a error.
    $$variable_name = $variable_value;
}

// II) View
// $__content__ = file_get_contents(VIEW_DIR .  $controler_name . DS . $action_name . '.php'); // => Alternative
ob_start();
include VIEW_DIR .  $controler_name . DS . $action_name . '.php';
$__content__ = ob_get_contents();
ob_end_clean();

// var_dump($_SERVER);

// III) Layout
include LAYOUT_DIR . $call_controller->getLayout(true);
