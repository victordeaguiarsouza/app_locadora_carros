<?php

namespace App\Routines\Auth;

use App\Commons\Contents\Content;
use Illuminate\Http\Request;

class Refresh 
{
    
    public static function execute(){

        try{

            $content = new Content();

            $token = auth('api')->refresh();

            if(!$token) throw new \Exception("Falha ao gerar o token.");
            
            $content->done    = true;
            $content->data    = ['token' => $token];
            $content->message = 'Successfully refresh token!';
        }
        catch(\Exception $e){

            $content->done      = false;
            $content->data      = ['token' => $token];
            $content->message   = $e->getMessage();
            $content->errorCode = $e->getCode();
            $content->errors    = $e->errors();
        }

        return response()->json($content);
    }

}