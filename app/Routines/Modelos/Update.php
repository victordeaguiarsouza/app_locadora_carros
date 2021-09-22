<?php

namespace App\Routines\Modelos;

use Illuminate\Support\Facades\Storage;
use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\UpdateBase;
use Illuminate\Http\Request;
use App\Models\Modelo;

class Update extends UpdateBase
{

    private $oldImage = null;

    protected function getModel(int $id){

        $model = Modelo::find($id);

        return $model;
    }

    public function execute(Request $request, int $id){

        if($request->method() === 'PATCH'){
            $this->rules    = Modelo::rulesPatch($id, $request->all());
            $this->feedback = Modelo::feedback();
        }else{
            $this->rules    = Modelo::rules($id);
            $this->feedback = Modelo::feedback();
        }

        return parent::update($request, $id);
    }

    protected function beforeAssign(){
        
        $this->oldImage = ($this->request->file('imagem'))? $this->model->imagem : null;
    }

    protected function beforeUpdate(){
        
        $image = $this->request->file('imagem');
 
        $this->model->imagem = $image->store('imagens/modelos', 'public');
    }

    protected function afterUpdate(){

        if($this->oldImage){
            Storage::disk('public')->delete($this->oldImage);
        }
    }

}