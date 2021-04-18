<?php

namespace Core\Config;

class Config
{
    private $config;

    public function __construct()
    {
        $this->config = include(CONFIG_DIR . DS . 'config.php');
    }

    /**
     * Return specific config in /config/config.php
     *
     * @param string $key The configuration key you need
     * @return void
     */
    public function getConfig(string $key = null)
    {
        return ($key) ? ((isset($this->config[$key])) ? $this->config[$key] : false)  : $this->config;
    }
}
