<?php

namespace App\Controller;

class PagesController extends Controller
{

    public function __construct()
    {
        parent::__contruct();
    }

    public function home()
    {
        $username = 'Lemeyer';

        $this->setVariable('username', $username);
    }
}
