<?php

namespace App\Commons\Mvc\Routines;

use App\Commons\Contents\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FindByIdBase 
{

    protected $model;

    protected function find(int $id, String $classModel){

        try{

            $content = new Content();

            $this->model = $this->buildFind($id, $classModel);

            if(!$this->model) throw new \Exception("Register not found!", 1);

            $content->done    = true;
            $content->data    = $this->model;
            $content->message = 'Register successfully find!';

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

    protected function buildFind(int $id, String $classModel){
        
        return $classModel::find($id);
    }

}