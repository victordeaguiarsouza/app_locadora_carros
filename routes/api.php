<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LocacaoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->middleware('jwt.auth')->group(function () {
    
    Route::apiResource('marca', MarcaController::class);
    Route::prefix('/marca')->group( function(){
        Route::put('/restore/{id}' , [MarcaController::class , 'restore']);
    });

    Route::apiResource('cliente', ClienteController::class); //não implementa as rotas create e edit.
    Route::prefix('/cliente')->group( function(){
        Route::put('/restore/{id}' , [ClienteController::class , 'restore']);
    });
    
    Route::apiResource('carro', CarroController::class);
    Route::prefix('/carro')->group( function(){
        Route::put('/restore/{id}' , [CarroController::class , 'restore']);
    });
    
    Route::apiResource('locacao', LocacaoController::class);
    Route::prefix('/locacao')->group( function(){
        Route::put('/restore/{id}' , [LocacaoController::class , 'restore']);
    });
    
    Route::apiResource('modelo', ModeloController::class);
    Route::prefix('/modelo')->group( function(){
        Route::put('/restore/{id}' , [ModeloController::class , 'restore']);
    });

    Route::post('me'     , [AuthController::class , 'me']);
    Route::post('refresh', [AuthController::class , 'refresh']);
    Route::post('logout' , [AuthController::class , 'logout']);
});




Route::post('login'  , [AuthController::class , 'login']);