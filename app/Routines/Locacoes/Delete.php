<?php

namespace App\Routines\Locacoes;

use App\Commons\Mvc\Routines\DeleteBase;
use Illuminate\Http\Request;
use App\Models\Locacao;

class Delete extends DeleteBase
{

    public function execute(int $id){

        return parent::delete(Locacao::class, $id);
    }

}