<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/AAErj9TT0vME9dj3cpg8coT3iwc9EZS35rI',[TelegramController::class,'GetMessage']);