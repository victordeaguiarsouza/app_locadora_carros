<?php

namespace App\Routines\Carros;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\RestoreBase;
use Illuminate\Http\Request;
use App\Models\Carro;

class Restore extends RestoreBase
{

    public function execute(int $id){

        return parent::restore(Carro::class, $id);
    }

}