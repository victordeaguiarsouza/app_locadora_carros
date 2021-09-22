<?php

namespace App\Routines\Clientes;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\FindAllBase;
use Illuminate\Http\Request;
use App\Models\Cliente;

class FindAll extends FindAllBase
{

    public function execute(Request $request){

        return parent::find(new Cliente, $request);
    }

    protected function buildFind($request){

        if($request->has('limite')){ 
            $this->setLimite($request->limite);
        }

        if($request->has('atributos_locacoes')){
            $this->selectAtributosRegistrosRelacionados('locacoes:id,' . $request->atributos_locacoes);
        }else{
            $this->selectAtributosRegistrosRelacionados('locacoes');
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