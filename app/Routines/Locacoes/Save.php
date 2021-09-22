<?php

namespace App\Routines\Locacoes;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\SaveBase;
use App\Models\Locacao;
use Illuminate\Http\Request;

class Save extends SaveBase
{

    protected function getModel(){

        return new Locacao();
    }

    public function execute(Request $request){
        
        $this->rules    = Locacao::rules();
        $this->feedback = Locacao::feedback();

        return parent::save($request);
    }

}