<?php

namespace App\Commons\Mvc\Routines;

use App\Commons\Contents\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateBase 
{

    protected $model;
    protected $request;
    protected $rules;
    protected $feedback;

    protected function getModel(int $id){}

    protected function getExtra(){ return null; }

    protected function update(Request $request, int $id){

        try{

            $content = new Content();
            
            $request->validate($this->rules, $this->feedback);

            $this->request = $request;

            $this->model = $this->getModel($id);

            if(!$this->model) throw new \Exception("Register not found.", 1);

            $this->beforeAssign();
            
            $this->assign();

            $this->beforeUpdate();
            
            $this->model->save();            
            
            $this->afterUpdate();

            $content->done    = true;
            $content->data    = $this->model;
            $content->message = 'Register successfully updated!';
            $content->extra   = $this->getExtra();

            $response = response()->json($content, 200);
        }
        catch(\Exception $e){

            $content->done      = false;
            $content->data      = $this->model;
            $content->message   = $e->getMessage();
            $content->errorCode = $e->getCode();

            $response = ($content->errorCode == 1)? response()->json($content, 404) : response()->json($content);
        }

        return $response;
    }

    protected function assign(){

        $this->model->fill($this->request->all());
    }

    protected function beforeAssign(){}

    protected function beforeUpdate(){}

    protected function afterUpdate(){}
}