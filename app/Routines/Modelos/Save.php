<?php

namespace App\Routines\Modelos;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\SaveBase;
use App\Models\Modelo;
use Illuminate\Http\Request;

class Save extends SaveBase
{

    protected function getModel(){

        return new Modelo();
    }

    public function execute(Request $request){
        
        $this->rules    = Modelo::rules();
        $this->feedback = Modelo::feedback();

        return parent::save($request);
    }

    protected function beforeSave(){
        
        $imagem = $this->request->file('imagem');

        $this->model->imagem = $imagem->store('imagens/modelos', 'public');
    }

}