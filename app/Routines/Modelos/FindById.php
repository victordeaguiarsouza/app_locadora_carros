<?php

namespace App\Routines\Modelos;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\FindByIdBase;
use Illuminate\Http\Request;
use App\Models\Modelo;

class FindById extends FindByIdBase
{

    public function execute(int $id){

        return parent::find($id, Modelo::class);
    }

    protected function buildFind(int $id, String $classModel){
        
        return $classModel::with('marca')->find($id);
    }

}