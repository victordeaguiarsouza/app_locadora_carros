<?php

namespace App\Routines\Marcas;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\RestoreBase;
use Illuminate\Http\Request;
use App\Models\Marca;

class Restore extends RestoreBase
{

    public function execute(int $id){

        return parent::restore(Marca::class, $id);
    }

}