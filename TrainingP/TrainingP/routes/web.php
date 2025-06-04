<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\AssistantController;
use App\Http\Controllers\User\OrganizationController;
use App\Http\Controllers\User\TraineeController;
use App\Http\Controllers\User\TrainerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// User Route - Adjusted for Session Authentication
Route::get('/user', function (Request $request) {
    return Auth::user();
})->middleware('auth');

// Auth Controller Routes
Route::get('/register', [AuthController::class, 'RegisterView'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/verify-user-page/{id}', [AuthController::class, 'verifyUserView'])->name('verify-user-blade');
Route::get('/verify-user/{id}', [AuthController::class, 'verifyUser'])->name('verify-user');





Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);



Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('/resend-verification-email/{id}', [AuthController::class, 'resendVerificationEmail'])->name('resend-verification-email');

// Trainer Controller
Route::get('/complete-trainer-register/{id}', [TrainerController::class, 'showRegistrationForm'])
    ->name('complete-trainer-register');
Route::post('/complete-trainer-register/{id}', [TrainerController::class, 'completeRegister'])->name('trainer.complete-register');


// Trainee Controller
Route::get('/complete-trainee-register/{id}', [TraineeController::class, 'showRegistrationForm'])
    ->name('complete-trainee-register');
Route::post('/complete-trainee-register/{id}', [TraineeController::class, 'completeRegister'])->name('trainee.complete-register');

// Assistant Controller
// Route::get('/complete-assistant-register/{id}', [AssistantController::class, 'showRegistrationForm'])
//     ->name('complete-assistant-register');
// Route::post('/complete-assistant-register/{id}', [AssistantController::class, 'completeRegister']);

// Organization Controller
// Route::get('/complete-organization-register/{id}', [OrganizationController::class, 'showRegistrationForm'])
//     ->name('complete-organization-register');
// Route::post('/complete-organization-register/{id}', [OrganizationController::class, 'completeRegister']);

// Middleware Group (Preserving Token Expiration Logic)
Route::middleware(['auth', 'tokenExpiration'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});