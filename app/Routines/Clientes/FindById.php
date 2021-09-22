<?php

namespace App\Routines\Clientes;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\FindByIdBase;
use Illuminate\Http\Request;
use App\Models\Cliente;

class FindById extends FindByIdBase
{

    public function execute(int $id){

        return parent::find($id, Cliente::class);
    }

    protected function buildFind(int $id, String $classModel){
        
        return $classModel::with('locacoes')->find($id);
    }

}