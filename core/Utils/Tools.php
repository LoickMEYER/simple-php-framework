<?php

namespace Core\Utils;

class Tools
{

    /**
     * Transform dashed string to camelCase
     *
     * @param string $string
     * @param boolean $capitalizeFirstCharacter
     * @return void
     */
    public static function dashesToCamelCase(string $string, $capitalizeFirstCharacter = false)
    {

        $str = str_replace('-', '', ucwords($string, '-'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * Var dump the variable, ande Die
     *
     * @param [type] $argument
     * @return void
     */
    public static function dd($argument)
    {
        var_dump($argument);
        die;
    }

    /**
     * Hash password passed in params
     *
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Transform the string into slug of this one
     *
     * @param string $string
     * @return void
     */
    public static function slug(string $string): string
    {
        // replace non letter or digits by -
        $string = preg_replace('~[^\pL\d]+~u', '-', $string);

        // transliterate
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);

        // remove unwanted characters
        $string = preg_replace('~[^-\w]+~', '', $string);

        // trim
        $string = trim($string, '-');

        // remove duplicate -
        $string = preg_replace('~-+~', '-', $string);

        // lowercase
        $string = strtolower($string);

        if (empty($string)) {
            return 'n-a';
        }

        return $string;
    }

    /**
     * Do a redirection to the URL passed
     *
     * @param string $url The URL to redirect. If it's an internal link, pass directly the URL like this : '/your-page' (without the domain name)
     * You can also pass an external link like this 'https://google.com'
     * @param integer $count_down The time in seconds before the redirection (Default 0)
     * @return void
     */
    public static function redirect(string $url = null, int $count_down = null)
    {
        if ($url) {
            if (strpos($url, 'http') === false) {
                $url = '/' . explode('/', trim($_SERVER['PHP_SELF'], '/'))[0] . '/' . trim($url, '/');
            }
        } else {
            /** By default we redirect on the current url */
            $url = $_SERVER['REQUEST_URI'];
        }
        if ($count_down) {
            header("refresh:$count_down;url=$url");
        } else {
            header("Location: $url");
        }
        exit;
    }
}
