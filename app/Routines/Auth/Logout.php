<?php

namespace App\Routines\Auth;

use App\Commons\Contents\Content;
use Illuminate\Http\Request;

class Logout 
{

    public static function execute(){

        try{

            $content = new Content();

            auth('api')->logout();
            
            $content->done    = true;
            $content->message = 'Successfully logout!';
        }
        catch(\Exception $e){

            $content->done      = false;
            $content->message   = $e->getMessage();
            $content->errorCode = $e->getCode();
            $content->errors    = $e->errors();
        }

        return response()->json($content);
    }

}