<?php

namespace App\Routines\Auth;

use App\Commons\Contents\Content;
use Illuminate\Http\Request;

class Login 
{
    /**
     * @param Array $credenciais
     * ['email','password']
     */
    public static function execute(Array $credenciais){

        try{

            $content = new Content();

            $token = auth('api')->attempt($credenciais);

            if(!$token) throw new \Exception("Falha ao autenticar. Verifique o email e a senha.");
            
            $content->done    = true;
            $content->data    = ['token' => $token];
            $content->message = 'Successfully authenticated!';
        }
        catch(\Exception $e){

            $content->done      = false;
            $content->data      = ['token' => $token];
            $content->message   = $e->getMessage();
            $content->errorCode = $e->getCode();
        }

        return response()->json($content);
    }

}