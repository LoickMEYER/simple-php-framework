<?php

/**
 * ⛔ DON'T TOUCH THE CODE BELOW ⛔
 */

require 'vendor/autoload.php';

require 'config/path.php';

use Core\Request\Request;

$request = new Request($_GET['url']);

$request->render();
