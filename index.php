<?php
require 'vendor/autoload.php';

require 'config/path.php';

use App\Router\Router;
use App\Utils\Tools;

$url = $_GET['url'];

// UTILS / TOOLS
$tools = new Tools();

// ROUTING 
$router = new Router();
$routes = $router->getRoutes();

// We look for personal route : 
if (isset($routes[$url])) {
    // Personal Rooting : 
    $controler = $routes[$url]['controller'];
    $action = $routes[$url]['action'];
} else {
    // Norma Routing
    $url_cleaned = trim($url, '/');

    $controler = explode('/', $url_cleaned)[0];
    $action = explode('/', $url_cleaned)[1];
    $parametters = explode('/', $url_cleaned)[2];
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


// III) Layout
include LAYOUT_DIR . $call_controller->getLayout(true);

