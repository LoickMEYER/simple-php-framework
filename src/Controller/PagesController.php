<?php

namespace App\Controller;

use App\Model\VillesModel;

class PagesController extends AppController
{

    public function __construct($request)
    {
        parent::__contruct($request);
    }

    public function home($id = null, $username = null)
    {
        var_dump($this->getRequest()->getData('tets'));
        var_dump($this->getRequest()->getAction());
        $username = 'Lemeyer';

        $this->setVariable('username', $username);
    }

    public function contact()
    {
        $villes_model = new VillesModel();
        $villes = $villes_model->getVilles();
        var_dump($villes);
        if ($this->getRequest()->is('POST')) {
            $this->setVariable('name', $this->getRequest()->getData('name'));
        }
    }
}
