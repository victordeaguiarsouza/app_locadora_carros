<?php

namespace App\Repositories;

abstract class AbstractRepository {
    
    protected $model;
    protected $limite = 50;

    public function __construct(String $classModel){
        $this->model = new $classModel();
    }

    public function selectAtributosRegistrosRelacionados(String $atributos){
        $this->model = $this->model->with($atributos);
    }

    public function selectAtributos(String $atributos){
        $this->model = $this->model->selectRaw($atributos)->get();
    }

    public function getResultado(){
        return $this->model;
    }

    public function filtro(String $filtro){

        $filtros = explode(";", $filtro);

        foreach ($filtros as $key => $condition) {
            $c = explode(":", $condition);
            $this->model = $this->model->where($c[0],$c[1],$c[2]);
        }
    }

    public function setLimite($limite){
        $limite = intval($limite);
        $this->limite = ( $limite < $this->limite && $limite > 0)? $limite : $this->limite;
    }
}

?>