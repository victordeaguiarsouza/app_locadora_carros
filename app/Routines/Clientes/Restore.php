<?php

namespace App\Routines\Clientes;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\RestoreBase;
use Illuminate\Http\Request;
use App\Models\Cliente;

class Restore extends RestoreBase
{

    public function execute(int $id){

        return parent::restore(Cliente::class, $id);
    }

}