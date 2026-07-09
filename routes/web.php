<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

Route::get('/', [SurveyController::class, 'show']);

Route::get('/survey', [SurveyController::class, 'show']);
Route::post('/survey', [SurveyController::class, 'submit'])->name('survey.submit');