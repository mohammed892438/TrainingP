<?php

use App\Http\Controllers\API\AssistantAPIController;
use App\Http\Controllers\API\OrganizationAPIController;
use App\Http\Controllers\API\TraineeAPIController;
use App\Http\Controllers\API\TrainerAPIController;
use App\Http\Controllers\API\TrainerCvAPIController;
use App\Http\Controllers\API\TrainingExperienceApiController;
use App\Http\Controllers\API\WorkExperienceApiController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

//auth controller
Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);
//verify email
Route::get('/verify-user/{id}', [AuthController::class, 'verifyUser'])->name('verify-user');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('/resend-verification/{id}', [AuthController::class, 'resendVerificationEmail']);


// Trainer controller
Route::post('/complete-trainer-register/{id}', [TrainerAPIController::class, 'completeRegister'])
    ->name('complete-trainer-register');

// Trainee controller
Route::post('/complete-trainee-register/{id}', [TraineeAPIController::class, 'completeRegister'])
    ->name('complete-trainee-register');

// Assistant controller
Route::post('/complete-assistant-register/{id}', [AssistantAPIController::class, 'completeRegister'])
    ->name('complete-assistant-register');

// Organization controller
Route::post('/complete-organization-register/{id}', [OrganizationAPIController::class, 'completeRegister'])
    ->name('complete-organization-register');

    //dont remove this syntax 
    // Route::middleware(['auth:api', 'tokenExpiration'])->group(function () {
    //     Route::post('/logout', [AuthController::class, 'logout']);
    // });


    //for test
//user cv controller
    Route::middleware('auth:api')->post('/upload-cv', [TrainerCvAPIController::class, 'uploadCv']);
    Route::middleware('auth:api')->get('/get-your-cv', [TrainerCvAPIController::class, 'getYourCv']);
    Route::middleware('auth:api')->put('/update-cv/{id}', [TrainerCvAPIController::class, 'updateCv']);
    Route::middleware('auth:api')->delete('/delete-cv', [TrainerCvAPIController::class, 'deleteCv']);

//work experinece
Route::middleware('auth:api')->post('/store-work-experience', [WorkExperienceApiController::class, 'storeWorkExperience']);
Route::middleware('auth:api')->put('/update-work-experience/{id}', [WorkExperienceApiController::class, 'updateWorkExperience']);
Route::middleware('auth:api')->delete('/delete-work-experience/{id}', [WorkExperienceApiController::class, 'deleteWorkExperience']);
Route::middleware('auth:api')->get('/get-work-experience', [WorkExperienceApiController::class, 'getWorkExperienceForUser']);

//training experience
Route::middleware('auth:api')->post('/store-training-experience', [TrainingExperienceApiController::class, 'storeTrainingExperience']);
Route::middleware('auth:api')->put('/update-training-experience/{id}', [TrainingExperienceApiController::class, 'updateTrainingExperience']);
Route::middleware('auth:api')->delete('/delete-training-experience/{id}', [TrainingExperienceApiController::class, 'deleteTrainingExperience']);
Route::middleware('auth:api')->get('/get-training-experience', [TrainingExperienceApiController::class, 'showTrainingExperience']);
