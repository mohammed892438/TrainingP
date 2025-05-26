<?php

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

