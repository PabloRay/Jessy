<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HandleMessageController;
use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LogController;
use App\Models\Expense;
use App\Models\HandleMessage;
use App\Models\Job;


Route::get('/GetJobs',[JobController::class,'GetJobs']);

Route::get('/GetJobById/{id}',[JobController::class,'GetJobById']);

Route::get('/DeleteJob/{id}',[JobController::class,'DeleteJob']);

Route::post('/AAErj9TT0vME9dj3cpg8coT3iwc9EZS35rI',[TelegramController::class,'GetMessage']);

Route::post('/SaveExpense',[ExpenseController::class,'SaveExpense']);

Route::post('/MainHandle',[HandleMessageController::class,'MainHandle']);