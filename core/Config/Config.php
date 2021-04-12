<?php

namespace Core\Config;

class Config
{
    private $config;

    public function __construct()
    {
        $this->config = include(CONFIG_DIR . DS . 'config.php');
    }

    public function getConfig(string $key = null)
    {
        return ($key) ? ((isset($this->config[$key])) ? $this->config[$key] : false)  : $this->config;
    }
}
