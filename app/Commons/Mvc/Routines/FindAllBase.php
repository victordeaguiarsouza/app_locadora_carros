<?php

namespace App\Commons\Mvc\Routines;

use App\Commons\Contents\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class FindAllBase {

    protected $model;
    protected $limite;

    abstract protected function buildFind($request);

    protected function find(Model $model, Request $request){

        try{

            $content = new Content();
            
            $this->model = $model;

            $this->buildFind($request);

            if(!$this->model) throw new \Exception("Register not found!", 1);

            $content->done    = true;
            $content->data    = $this->model;
            $content->message = 'Registers successfully find!';
            $content->extra   = ['limite' => $this->limite];

            $response = response()->json($content, 200);
        }
        catch(\Exception $e){

            $content->done      = false;
            $content->data      = $this->model;
            $content->message   = $e->getMessage();
            $content->errorCode = $e->getCode();

            $response = ($content->errorCode == 1)? response()->json($content, 404) : response()->json($content);
        }

        return $response;
    }

    protected function selectAtributosRegistrosRelacionados(String $atributos){
        $this->model = $this->model->with($atributos);
    }

    protected function selectAtributos(String $atributos){
        $this->model = $this->model->selectRaw($atributos)->get();
    }

    protected function filtro(String $filtro){

        $filtros = explode(";", $filtro);

        foreach ($filtros as $key => $condition) {
            $c = explode(":", $condition);
            $this->model = $this->model->where($c[0],$c[1],$c[2]);
        }
    }

    protected function setLimite($limite){
        $limite = intval($limite);
        $this->limite = ( $limite < $this->limite && $limite > 0)? $limite : $this->limite;
    }

}