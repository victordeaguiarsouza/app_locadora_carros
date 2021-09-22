<?php

namespace App\Routines\Modelos;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\RestoreBase;
use Illuminate\Http\Request;
use App\Models\Modelo;

class Restore extends RestoreBase
{

    public function execute(int $id){

        return parent::restore(Modelo::class, $id);
    }

}