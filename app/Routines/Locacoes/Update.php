<?php

namespace App\Routines\Locacoes;

use Illuminate\Support\Facades\Storage;
use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\UpdateBase;
use Illuminate\Http\Request;
use App\Models\Locacao;

class Update extends UpdateBase
{

    protected function getModel(int $id){

        $model = Locacao::find($id);

        return $model;
    }

    public function execute(Request $request, int $id){

        if($request->method() === 'PATCH'){
            $this->rules    = Locacao::rulesPatch($id, $request->all());
            $this->feedback = Locacao::feedback();
        }else{
            $this->rules    = Locacao::rules($id);
            $this->feedback = Locacao::feedback();
        }

        return parent::update($request, $id);
    }
 
}