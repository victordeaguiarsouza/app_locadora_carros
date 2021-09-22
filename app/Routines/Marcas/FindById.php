<?php

namespace App\Routines\Marcas;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\FindByIdBase;
use Illuminate\Http\Request;
use App\Models\Marca;

class FindById extends FindByIdBase
{

    public function execute(int $id){

        return parent::find($id, Marca::class);
    }

    protected function buildFind(int $id, String $classModel){
        
        return $classModel::with('modelos')->find($id);
    }

}