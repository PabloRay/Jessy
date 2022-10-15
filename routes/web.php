<?php

use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HandleMessageController;
use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\WebScrapingController;
use App\Models\Expense;
use App\Models\HandleMessage;
use App\Models\Job;


Route::get('/GetJobs',[JobController::class,'GetJobs']);

Route::get('/GetJobById/{id}',[JobController::class,'GetJobById']);

Route::get('/DeleteJob/{id}',[JobController::class,'DeleteJob']);

Route::post('/AAErj9TT0vME9dj3cpg8coT3iwc9EZS35rI',[WebhookController::class,'GetMessage']);

Route::post('/SaveExpense',[ExpenseController::class,'SaveExpense']);

Route::post('/MainHandle',[HandleMessageController::class,'MainHandle']);

Route::get('/Scrap',[WebScrapingController::class,'GetOldMatches']);

Route::get('/CurrentMatches',[WebScrapingController::class,'GetCurrentMatches']);

Route::get('/PreMatches',[WebScrapingController::class,'GetPreMatches']);

Route::get('/GetPos',[WebScrapingController::class,'GetTeamPositions']);

Route::get('/GetStats',[WebScrapingController::class,'GetTeamStatistics']);

Route::get('/GetAllExpenses',[ExpenseController::class,'ShowAllExpenses']);

Route::get('/GetExpenseNotPayed',[ExpenseController::class,'GetExpenseNotPayed']);

Route::get('/UpdateExpense/{id}',[ExpenseController::class,'UpdateExpense']);

Route::get('/DoReminder',[ReminderController::class,'DoReminder']);