<?php

namespace App\Routines\Auth;

use App\Commons\Contents\Content;
use Illuminate\Http\Request;

class Me 
{
    /**
     * 
     * @return $content
     */
    public static function execute(){

        try{

            $content = new Content();

            $user = auth()->user();

            $content->done    = true;
            $content->data    = ['user' => $user];
            $content->message = 'Register successfully find!';
        }
        catch(\Exception $e){

            $content->done      = false;
            $content->data      = ['user' => $user];
            $content->message   = $e->getMessage();
            $content->errorCode = $e->getCode();
            $content->errors    = $e->errors();
        }

        return response()->json($content);
    }

}