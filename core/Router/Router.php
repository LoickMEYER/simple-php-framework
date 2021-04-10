<?php

namespace Core\Router;

class Router
{

    /**
     * Documentation : 
     * @TODO
     */
    private $routes = [
        '/' => ['controller' => 'Pages', 'action' => 'home'],
        '/article/:id' => ['controller' => 'Pages', 'action' => 'home'],
    ];

    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return false if 0 route was found
     * @return $route if a route was found
     */
    public function match($url)
    {
        foreach ($this->routes as $url_route => $route) {

            $clean_url = trim($url, '/');
            $clean_url_route = trim($url_route, '/');
            if ($clean_url == $clean_url_route) {
                return $route;
            }
            $url_exploded = explode('/', $clean_url);
            $url_route_exploded = explode('/', $clean_url_route);
            if (count($url_exploded) !== count($url_route_exploded)) {
                continue;
            }

            /**
             * Both URLs have the same pattern 
             * Now, let's see if string match
             */
            for ($i = 0; $i < count($url_exploded); $i++) {
                $url_part = $url_exploded[$i];
                $url_route_part = $url_route_exploded[$i];

                // have a " : " ?
                if (strpos($url_route_part, ':') !== false) {
                    /**
                     * It's a parameters so we continue to the next part
                     */
                    continue;
                } else {
                    if ($url_part !== $url_route_part) {
                        /**
                         * Not match so we pass to the next Route
                         */
                        continue 2;
                    }
                }
            }

            /**
             * All tests have been passed so we return the route
             */
            return $route;
        }
        return false;
    }
}
