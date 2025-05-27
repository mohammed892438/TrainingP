<?php

use App\Http\Controllers\API\AssistantAPIController;
use App\Http\Controllers\API\OrganizationAPIController;
use App\Http\Controllers\API\TraineeAPIController;
use App\Http\Controllers\API\TrainerAPIController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

//auth controller
Route::post('/register',[AuthController::class,'register']);

//trainer controller
Route::post('/complete-trainer-register/{id}',[TrainerAPIController::class,'completeRegister']);

//trainee controller
Route::post('/complete-trainee-register/{id}',[TraineeAPIController::class,'completeRegister']);

//assistant controller
Route::post('/complete-assistant-register/{id}',[AssistantAPIController::class,'completeRegister']);

//organization controller
Route::post('/complete-organization-register/{id}',[OrganizationAPIController::class,'completeRegister']);
