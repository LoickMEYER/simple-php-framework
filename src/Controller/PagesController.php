<?php

namespace App\Controller;


class PagesController extends AppController
{

    public function __construct($request)
    {
        parent::__contruct($request);
    }

    public function home($id = null, $username = null)
    {
        var_dump($this->getRequest()->is(['POST', 'GET']));
        var_dump($this->getRequest()->getAction());
        $username = 'Lemeyer';

        $this->setVariable('username', $username);
    }
}
