<?php

namespace App\Routines\Carros;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\FindAllBase;
use Illuminate\Http\Request;
use App\Models\Carro;

class FindAll extends FindAllBase
{

    public function execute(Request $request){

        return parent::find(new Carro, $request);
    }

    protected function buildFind($request){

        if($request->has('limite')){ 
            $this->setLimite($request->limite);
        }

        if($request->has('atributos_modelo')){
            $this->selectAtributosRegistrosRelacionados('modelo:id,' . $request->atributos_modelo);
        }else{
            $this->selectAtributosRegistrosRelacionados('modelo');
        }

        if($request->has('filtro')){ 
            $this->filtro($request->filtro); 
        }

        if($request->has('atributos')){
            $this->selectAtributos($request->atributos);
        }

        return $this->model;
    }
}