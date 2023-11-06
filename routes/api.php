<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlanosController;

Route::get('/planos',[PlanosController::class,'index']);
Route::post('/planos',[PlanosController::class,'newPlano']);

Route::get('/',function(){
    return response()->json([
        'sucess' => true
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
