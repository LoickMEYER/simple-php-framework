<?php
return [

    /**
     * Default route for Home page
     */
    '/' => ['controller' => 'Pages', 'action' => 'home'],

    /**
     * Write your custom routes below 
     */
    '/article/:id' => ['controller' => 'Pages', 'action' => 'home'],
    '/contact' => ['controller' => 'Pages', 'action' => 'contact'],
];
