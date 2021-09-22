<?php

namespace App\Routines\Marcas;

use Illuminate\Support\Facades\Storage;
use App\Commons\Contents\Content;
use App\Commons\Mvc\Routines\UpdateBase;
use Illuminate\Http\Request;
use App\Models\Marca;

class Update extends UpdateBase
{

    private $oldImage = null;

    protected function getModel(int $id){

        $model = Marca::find($id);

        return $model;
    }

    public function execute(Request $request, int $id){

        if($request->method() === 'PATCH'){
            $this->rules    = Marca::rulesPatch($id, $request->all());
            $this->feedback = Marca::feedback();
        }else{
            $this->rules    = Marca::rules($id);
            $this->feedback = Marca::feedback();
        }

        return parent::update($request, $id);
    }

    protected function beforeAssign(){
        
        $this->oldImage = ($this->request->file('imagem'))? $this->model->imagem : null;
    }

    protected function beforeUpdate(){
        
        $image = $this->request->file('imagem');
 
        $this->model->imagem = $image->store('imagens/marcas', 'public');
    }

    protected function afterUpdate(){

        if($this->oldImage){
            Storage::disk('public')->delete($this->oldImage);
        }
    }

}