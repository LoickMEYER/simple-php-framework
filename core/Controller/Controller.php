<?php

namespace Core\Controller;

use Core\Request\Request;
use Exception;

class Controller
{
    private $layout = 'default';
    private $variables = [];
    private $request;

    /**
     * Constructor of the Controller Class
     *
     * @param Request $request The context request
     * @return void
     */
    public function __contruct(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * Get the current layout used
     *
     * @param boolean $extension If true, the extension ".php" will be return with the extension name
     * @return string
     */
    public function getLayout($extension = false): string
    {
        return $this->layout . (($extension) ? '.php' : '');
    }

    /**
     * Set the layout 
     *
     * @param string $layout name of layout with or without extension
     * @return void
     */
    public function setLayout(string $layout): void
    {
        // We check if the user have passed the parameter with the ".php" extension or not.
        $extension = (strpos($layout, '.php')) ? '' : '.php';
        if (file_exists(LAYOUT_DIR . $layout . $extension)) {
            $this->layout = str_replace('.php', '', $layout);
        } else {
            throw new Exception('The specified layout < ' . $layout . $extension . ' > does not exist. Create it in ' . LAYOUT_DIR . $layout . $extension);
        }
    }

    /**
     * Set the variable that will be use in the view.
     *
     * @param string $name Name of the variable that will be use in the view.
     * @param [type] $value Value of the variable
     * @return void
     */
    public function setVariable(string $name = null, $value = null): void
    {
        if (!$name || !$value) {
            throw new Exception('Parameters Missing setVariable() require 2 parameters : $name & $value.');
        }

        $this->variables[$name] = $value;
    }

    /**
     * Get the list of variables that will be use in the view
     *
     * @return array List of variables
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * Get the request
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    public function hook()
    {
    }
}
