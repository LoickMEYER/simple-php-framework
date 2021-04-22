<?php

/**
 * ⛔ DON'T TOUCH THE CODE BELOW ⛔
 */

require 'vendor/autoload.php';

require 'config/path.php';

require 'core/include/functions.php';

use Core\Request\Request;

use Core\Config\Config;

$config = new Config();

if ($config->getConfig('debug')) {
    /** Debug Mode */
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(E_ALL ^ E_WARNING);
}


$request = new Request($_GET['url']);

$request->render();
