<?php

/**
 * Var dump the variable, ande Die
 *
 * @param [type] $argument
 * @return void
 */
function dd($argument)
{
    echo '<pre>';
    var_dump($argument);
    echo '</pre>';
    die;
}

/**
 * Undocumented function
 *
 * @param string $url
 * @param boolean $full_base
 * @return string
 */
function buildUrl(string $url = '/', bool $full_base = false): string
{
    if ($full_base) {
        $protocol = strtolower(explode('/', $_SERVER['SERVER_PROTOCOL'])[0]);
        $s = (!empty($_SERVER['HTTPS'])) ? (($_SERVER['HTTPS'] == 'on') ? 's' : '') : '';
        // var_dump($url);
        $url = $protocol . $s . '://' . $_SERVER['HTTP_HOST'] . buildUrl($url, false);
    } else {
        $script_name = trim($_SERVER['SCRIPT_NAME'], '/');
        $script_name_exploded = explode('/', $script_name);

        if (count($script_name_exploded) == 2) {
            // /project/index.php
            $url = '/' . $script_name_exploded[0] . '/' . trim($url, '/');
        } else {
            $url = '/' . trim($url, '/');
        }
    }
    return $url;
}
