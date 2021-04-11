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
 * The Full Pass to the config Directory
 */
define('CONFIG_DIR', ROOT . DS . 'config');

/*
 * File path to the webroot directory.
 *
 * To derive your webroot from your webserver change this to:
 *
 * `define('WWW_ROOT', rtrim($_SERVER['DOCUMENT_ROOT'], DS) . DS);`
 */
define('WWW_ROOT',  'webroot' . DS);

/**
 * The Full Pass to the View Directory
 */
define('VIEW_DIR', ROOT . DS . APP_DIR . DS . 'View' . DS);


/**
 * The Full Pass to the Layout Directory
 */
define('LAYOUT_DIR', VIEW_DIR . 'layout' . DS);


/**
 * The Full Pass to the Webroot CSS Directory
 */
define('CSS_DIR', WWW_ROOT . 'css' . DS);


/**
 * The Full Pass to the Webroot JS Directory
 */
define('JS_DIR', WWW_ROOT . 'js' . DS);


/**
 * The Full Pass to the Webroot IMG Directory
 */
define('IMG_DIR', WWW_ROOT . 'img' . DS);


/**
 * The Full Pass to the Webroot FILES Directory
 */
define('FILES_DIR', WWW_ROOT . 'files' . DS);


/**
 * Add personal path below
 */
