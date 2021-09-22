<?php

namespace App\Commons\Mvc\Routines;

use App\Commons\Contents\Content;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SaveBase 
{

    protected $model;
    protected $request;
    protected $rules;
    protected $feedback;

    protected function getModel(){}

    protected function getExtra(){ return null; }

    protected function save(Request $request){

        try{

            $content = new Content();
            
            $request->validate($this->rules, $this->feedback);

            $this->request = $request;

            $this->model = $this->getModel();

            $this->assign();

            $this->beforeSave();
            
            $this->model->save();            
            
            $this->afterSave();

            $content->done    = true;
            $content->data    = $this->model;
            $content->message = 'Register successfully saved!';
            $content->extra   = $this->getExtra();
        }
        catch(\Exception $e){

            $content->done      = false;
            $content->data      = $this->model;
            $content->message   = $e->getMessage();
            $content->errorCode = $e->getCode();
            $content->errors    = $e->errors();

        }

        return response()->json($content);
    }

    protected function assign(){

        $this->model->fill($this->request->all());
    }

    protected function beforeSave(){}

    protected function afterSave(){}
}