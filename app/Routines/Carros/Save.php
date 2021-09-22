<?php

namespace App\Routines\Carros;

use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\SaveBase;
use App\Models\Carro;
use Illuminate\Http\Request;

class Save extends SaveBase
{

    protected function getModel(){

        return new Carro();
    }

    public function execute(Request $request){
        
        $this->rules    = Carro::rules();
        $this->feedback = Carro::feedback();

        return parent::save($request);
    }

}