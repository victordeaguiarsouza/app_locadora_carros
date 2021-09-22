<?php

namespace App\Routines\Clientes;

use App\Commons\Mvc\Routines\DeleteBase;
use Illuminate\Http\Request;
use App\Models\Cliente;

class Delete extends DeleteBase
{

    public function execute(int $id){

        return parent::delete(Cliente::class, $id);
    }

}