<?php

namespace App\Routines\Locacoes;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\RestoreBase;
use Illuminate\Http\Request;
use App\Models\Locacao;

class Restore extends RestoreBase
{

    public function execute(int $id){

        return parent::restore(Locacao::class, $id);
    }

}