<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

/*
 * The full path to the directory which holds "src", WITHOUT a trailing DS.
 */
define('ROOT', dirname(__DIR__));

/*
 * The actual directory name for the application directory. Normally
 * named 'src'.
 */
define('APP_DIR', 'src');


/**
 * The path to the config Directory
 */
define('CONFIG_DIR', ROOT . DS . 'config');

/*
 * File path to the webroot directory.
 *
 * To derive your webroot from your webserver change this to:
 *
 * `define('WWW_ROOT', rtrim($_SERVER['DOCUMENT_ROOT'], DS) . DS);`
 * ../../../webroot/
 */
define('WWW_ROOT', ROOT . DS . 'webroot' . DS);

/**
 * The full path to the View Directory
 */
define('VIEW_DIR', ROOT . DS . APP_DIR . DS . 'View' . DS);


/**
 * The full path to the Layout Directory
 */
define('LAYOUT_DIR', VIEW_DIR . 'layout' . DS);

/**
 * The path to the Webroot Directory
 */
define('WEBROOT', DS . explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0] . DS . 'webroot' . DS);

/**
 * The path to the Webroot CSS Directory
 */
define('CSS_DIR', WEBROOT . 'css' . DS);


/**
 * The path to the Webroot JS Directory
 */
define('JS_DIR', WEBROOT . 'js' . DS);


/**
 * The path to the Webroot IMG Directory
 */
define('IMG_DIR', WEBROOT . 'img' . DS);


/**
 * The path to the Webroot FILES Directory
 */
define('FILES_DIR', WEBROOT . 'files' . DS);


/**
 * ⬇ Add personal path below ⬇
 */
