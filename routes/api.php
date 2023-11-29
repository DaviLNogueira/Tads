<?php

use App\Http\Controllers\Api\AssinaturaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlanosController;
Route::get('/planos',[PlanosController::class,'all']);
Route::post('/planos',[PlanosController::class,'new']);
Route::delete('/planos/{id}',[PlanosController::class,'delete']);
Route::patch('/planos/{id}',[PlanosController::class,'edit']);

Route::get('/assinatura',[AssinaturaController::class,'index']);
Route::post('/assinatura',[AssinaturaController::class,'store']);
Route::patch('/assinatura/{id}',[AssinaturaController::class,'update']);
Route::get('/assinatura/{id}',[AssinaturaController::class,'show']);
Route::get('/cliente',[AssinaturaController::class,'getAssinaturaByClienteId']);
Route::delete('/assinatura/{id}',[AssinaturaController::class,'destroy']);

Route::get('/',function(){
    return response()->json([
        'sucess' => true
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
