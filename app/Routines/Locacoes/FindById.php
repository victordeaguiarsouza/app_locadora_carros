<?php

namespace App\Routines\Locacoes;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\FindByIdBase;
use Illuminate\Http\Request;
use App\Models\Locacao;

class FindById extends FindByIdBase
{

    public function execute(int $id){

        return parent::find($id, Locacao::class);
    }

    protected function buildFind(int $id, String $classModel){
        
        return $classModel::with('cliente')->with('carro')->find($id);
    }

}