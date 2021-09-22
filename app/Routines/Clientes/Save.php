<?php

namespace App\Routines\Clientes;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\SaveBase;
use App\Models\Cliente;
use Illuminate\Http\Request;

class Save extends SaveBase
{

    protected function getModel(){

        return new Cliente();
    }

    public function execute(Request $request){
        
        $this->rules    = Cliente::rules();
        $this->feedback = Cliente::feedback();

        return parent::save($request);
    }

}