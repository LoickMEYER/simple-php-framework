<?php

namespace App\Model;

use Core\Model\Model;

class VillesModel extends Model
{

    public function getVilles()
    {
        return $this
            ->setQuery('select * from villes')
            ->bindParam(':id', 2)
            ->first();
    }
}
