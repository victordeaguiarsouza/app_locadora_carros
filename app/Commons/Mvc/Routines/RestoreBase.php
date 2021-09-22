<?php

namespace App\Commons\Mvc\Routines;

use App\Commons\Contents\Content;
use Illuminate\Database\Eloquent\Model;

class RestoreBase 
{

    public function restore(string $classModel, int $id)
    {

        $content = new Content();

        try {

            $model = $classModel::withTrashed()->find($id);
            
            if(!$model) throw new \Exception("Register not found.", 1);

            $this->beforeRestore($model);

            $model->restore();

            $this->afterRestore($model);

            $content->done    = true;
            $content->data    = $model;
            $content->message = 'Register successfully restored!';

            $response = response()->json($content, 200);
        }
        catch(\Exception $e){
            
            $content->done      = false;
            $content->data      = $model;
            $content->message   = $e->getMessage();
            $content->errorCode = $e->getCode();

            $response = ($content->errorCode == 1)? response()->json($content, 404) : response()->json($content);
        }        

        return $response;
    }

    protected function beforeRestore(Model $model){}

    protected function afterRestore(Model $model){}
}