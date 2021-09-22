<?php

namespace App\Routines\Carros;

use App\Commons\Mvc\Routines\DeleteBase;
use Illuminate\Http\Request;
use App\Models\Carro;

class Delete extends DeleteBase
{

    public function execute(int $id){

        return parent::delete(Carro::class, $id);
    }

}