<?php

namespace App\Routines\Modelos;

use App\Commons\Mvc\Routines\DeleteBase;
use Illuminate\Http\Request;
use App\Models\Modelo;

class Delete extends DeleteBase
{

    public function execute(int $id){

        return parent::delete(Modelo::class, $id);
    }

}