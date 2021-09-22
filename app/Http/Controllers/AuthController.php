<?php

namespace App\Http\Controllers;

use App\Routines\Auth\Login;
use App\Routines\Auth\Logout;
use App\Routines\Auth\Me;
use App\Routines\Auth\Refresh;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request){

        return Login::execute($request->all(['email', 'password']));
    }

    public function logout(){
        return Logout::execute();
    }
    
    public function refresh(){
        return Refresh::execute();
    }
    
    public function me(){
        return Me::execute();
    }

}