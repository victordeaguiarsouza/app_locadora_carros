<?php

namespace App\Commons\Mvc\Routines;

use App\Commons\Contents\Content;
use Illuminate\Database\Eloquent\Model;

class DeleteBase 
{

    public function delete(string $classModel, int $id)
    {

        $content = new Content();

        try {
            
            $model = $classModel::find($id);

            if(!$model) throw new \Exception("Register not found.", 1);

            $this->beforeDelete($model);

            $model->delete();

            $this->afterDelete($model);

            $content->done    = true;
            $content->data    = $model;
            $content->message = 'Register successfully deleted!';

            $response = response()->json($content, 200);
        }
        catch(\Exception $e){
            
            $content->done      = false;
            $content->data      = $model;
            $content->errorCode = $e->getCode();
            $content->message   = $e->getMessage();

            $response = ($content->errorCode == 1)? response()->json($content, 404) : response()->json($content);
        }        

        return $response;
    }

    protected function beforeDelete(Model $model){}
    protected function afterDelete(Model $model){}

}