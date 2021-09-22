<?php

namespace App\Routines\Marcas;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\SaveBase;
use App\Models\Marca;
use Illuminate\Http\Request;

class Save extends SaveBase
{

    protected function getModel(){

        return new Marca();
    }

    public function execute(Request $request){
        
        $this->rules    = Marca::rules();
        $this->feedback = Marca::feedback();

        return parent::save($request);
    }

    protected function beforeSave(){
        
        $imagem = $this->request->file('imagem');

        $this->model->imagem = $imagem->store('imagens/marcas', 'public');
    }

}