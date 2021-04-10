<?php

namespace App\Controller;

use Exception;

/**
 * 
 */
class Controller
{
    private $layout;
    private $variables = [];

    public function __contruct($layout = 'default'): void
    {
        $this->setLayout($layout);
    }

    public function getLayout($extension = false): string
    {
        return $this->layout . (($extension) ? '.php' : '');
    }

    public function setLayout(string $layout): void
    {
        if (file_exists(LAYOUT_DIR . $layout . '.php')) {
            $this->layout = $layout;
        } else {
            throw new Exception('The specified layout < ' . $layout . '.php > does not exist. Create it in ' . LAYOUT_DIR . $layout . '.php');
        }
    }

    /**
     * @TODO
     */
    public function setVariable(string $name = null, $value = null): void
    {
        if (!$name || !$value) {
            throw new Exception('Parameters Missing setVariable() require 2 parameters : $name & $value.');
        }

        $this->variables[$name] = $value;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }
}
