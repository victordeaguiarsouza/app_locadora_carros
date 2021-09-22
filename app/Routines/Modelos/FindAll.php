<?php

namespace App\Routines\Modelos;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\FindAllBase;
use Illuminate\Http\Request;
use App\Models\Modelo;

class FindAll extends FindAllBase
{

    public function execute(Request $request){

        return parent::find(new Modelo, $request);
    }

    protected function buildFind($request){

        if($request->has('limite')){ 
            $this->setLimite($request->limite);
        }

        if($request->has('atributos_marca')){
            $this->selectAtributosRegistrosRelacionados('marca:id,' . $request->atributos_marca);
        }else{
            $this->selectAtributosRegistrosRelacionados('marca');
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