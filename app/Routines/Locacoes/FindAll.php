<?php

namespace App\Routines\Locacoes;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\FindAllBase;
use Illuminate\Http\Request;
use App\Models\Locacao;

class FindAll extends FindAllBase
{

    public function execute(Request $request){

        return parent::find(new Locacao, $request);
    }

    protected function buildFind($request){

        if($request->has('limite')){ 
            $this->setLimite($request->limite);
        }

        if($request->has('atributos_cliente')){
            $this->selectAtributosRegistrosRelacionados('cliente:id,' . $request->atributos_cliente);
        }else{
            $this->selectAtributosRegistrosRelacionados('cliente');
        }

        if($request->has('atributos_carro')){
            $this->selectAtributosRegistrosRelacionados('carro:id,' . $request->atributos_carro);
        }else{
            $this->selectAtributosRegistrosRelacionados('carro');
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