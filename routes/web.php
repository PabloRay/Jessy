<?php

use App\Http\Controllers\AAErj9TT0vME9dj3cpg8coT3iwc9EZS35rI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PostController;
use App\Models\Job;

Route::get('/',[PostController::class, 'index']);

Route::get('/GetJobs',[JobController::class,'GetJobs']);

Route::get('/GetJobById/{id}',[JobController::class,'GetJobById']);

Route::get('/DeleteJob/{id}',[JobController::class,'DeleteJob']);

Route::get('/AAErj9TT0vME9dj3cpg8coT3iwc9EZS35rI',[telegramController::class,'GetUpdate']);