<?php

namespace App\Routines\Carros;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\FindByIdBase;
use Illuminate\Http\Request;
use App\Models\Carro;

class FindById extends FindByIdBase
{

    public function execute(int $id){

        return parent::find($id, Carro::class);
    }

    protected function buildFind(int $id, String $classModel){
        
        return $classModel::with('modelo')->find($id);
    }

}