<?php

namespace App\Routines\Clientes;

use Illuminate\Support\Facades\Storage;
use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\UpdateBase;
use Illuminate\Http\Request;
use App\Models\Cliente;

class Update extends UpdateBase
{

    protected function getModel(int $id){

        $model = Cliente::find($id);

        return $model;
    }

    public function execute(Request $request, int $id){

        if($request->method() === 'PATCH'){
            $this->rules    = Cliente::rulesPatch($id, $request->all());
            $this->feedback = Cliente::feedback();
        }else{
            $this->rules    = Cliente::rules($id);
            $this->feedback = Cliente::feedback();
        }

        return parent::update($request, $id);
    }

}