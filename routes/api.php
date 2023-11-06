<?php

use App\Http\Controllers\Api\AssinaturaControle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlanosController;

Route::get('/planos',[PlanosController::class,'all']);
Route::post('/planos',[PlanosController::class,'new']);
Route::delete('/planos/{id}',[PlanosController::class,'delete']);
Route::patch('/planos/{id}',[PlanosController::class,'edit']);

Route::get('/assinatura',[AssinaturaControle::class,'index']);
Route::post('/assinatura',[AssinaturaControle::class,'store']);
Route::patch('/assinatura/{id]',[AssinaturaControle::class,'update']);
Route::get('/assinatura/{id]',[AssinaturaControle::class,'show']);
Route::delete('/assinatura/{id]',[AssinaturaControle::class,'destroy']);

Route::get('/',function(){
    return response()->json([
        'sucess' => true
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
