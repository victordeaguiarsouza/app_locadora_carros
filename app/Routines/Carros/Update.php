<?php

namespace App\Routines\Carros;

use Illuminate\Support\Facades\Storage;
use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\UpdateBase;
use Illuminate\Http\Request;
use App\Models\Carro;

class Update extends UpdateBase
{

    protected function getModel(int $id){

        $model = Carro::find($id);

        return $model;
    }

    public function execute(Request $request, int $id){

        if($request->method() === 'PATCH'){
            $this->rules    = Carro::rulesPatch($id, $request->all());
            $this->feedback = Carro::feedback();
        }else{
            $this->rules    = Carro::rules($id);
            $this->feedback = Carro::feedback();
        }

        return parent::update($request, $id);
    }

}