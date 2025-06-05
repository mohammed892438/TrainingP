<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\AssistantController;
use App\Http\Controllers\User\OrganizationController;
use App\Http\Controllers\User\TraineeController;
use App\Http\Controllers\User\TrainerController;
use App\Http\Controllers\User\TrainerCvController;
use App\Http\Controllers\User\TrainingExperienceController;
use App\Http\Controllers\User\WorkExperienceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// User Route - Adjusted for Session Authentication
Route::get('/user', function (Request $request) {
    return Auth::user();
})->middleware('auth');

Route::get('/', function () {
    return view('homePage');
});

//home page
Route::get('/homePage', [AuthController::class, 'View'])->name('homePage');
Route::get('/homePageOrganization', [AuthController::class, 'ViewOrganization'])->name('homePageOrganization');

// Auth Controller Routes
Route::get('/register', [AuthController::class, 'RegisterView'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/verify-user-page/{id}', [AuthController::class, 'verifyUserView'])->name('verify-user-blade');
Route::get('/verify-user/{id}', [AuthController::class, 'verifyUser'])->name('verify-user');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);



Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
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
Route::get('/complete-assistant-register/{id}', [AssistantController::class, 'showRegistrationForm'])
    ->name('complete-assistant-register');
Route::post('/complete-assistant-register/{id}', [AssistantController::class, 'completeRegister'])->name('assistant.complete-register');

// Organization Controller
Route::get('/complete-organization-register/{id}', [OrganizationController::class, 'showRegistrationForm'])
    ->name('complete-organization-register');
Route::post('/complete-organization-register/{id}', [OrganizationController::class, 'completeRegister'])->name('organization-complete-register');

// Middleware Group (Preserving Token Expiration Logic)
Route::middleware('auth:web')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    //trainer cv
    Route::get('/trainer/cv/view', [TrainerCvController::class, 'getYourCv'])->name('trainer.cv.view');
    Route::get('/trainer/cv/update/{id}', [TrainerCvController::class, 'showUpdateForm'])->name('trainer.cv.update.form');
    Route::get('/trainer/cv/form', [TrainerCvController::class, 'showCvForm'])->name('trainer.cv.form');
    Route::get('/trainer/cv/redirect', [TrainerCvController::class, 'redirectToCvForm'])->name('trainer.cv.redirect');
    Route::post('/trainer/cv/upload', [TrainerCvController::class, 'uploadCv'])->name('trainer.cv.upload');
    Route::get('/trainer/cv', [TrainerCvController::class, 'getYourCv'])->name('trainer.cv.get');
    Route::put('/trainer/cv/update/{id}', [TrainerCvController::class, 'updateCv'])->name('trainer.cv.update');
    Route::delete('/trainer/cv/delete', [TrainerCvController::class, 'deleteCv'])->name('trainer.cv.delete');

    //training experience
    Route::get('/training-experience', [TrainingExperienceController::class, 'showTrainingExperience'])->name('training_experience.index');
    Route::get('/training-experience/store', [TrainingExperienceController::class, 'storeTrainingExperienceForm'])->name('training_experience.store.form');
    Route::post('/training-experience', [TrainingExperienceController::class, 'storeTrainingExperience'])->name('training_experience.store');
    Route::get('/training-experience/update/{id}', [TrainingExperienceController::class, 'updateTrainingExperienceForm'])->name('training_experience.update.form');
    Route::put('/training-experience/{id}', [TrainingExperienceController::class, 'updateTrainingExperience'])->name('training_experience.update');
    Route::delete('/training-experience/{id}', [TrainingExperienceController::class, 'deleteTrainingExperience'])->name('training_experience.delete');

    //work experience
    Route::get('/work-experience', [WorkExperienceController::class, 'index'])->name('work_experience.index');
    Route::get('/work-experience/store', [WorkExperienceController::class, 'storeWorkExperienceForm'])->name('work_experience.store.form');
    Route::post('/work-experience', [WorkExperienceController::class, 'storeWorkExperience'])->name('work_experience.store');
    Route::get('/work-experience/update/{id}', [WorkExperienceController::class, 'updateWorkExperienceForm'])->name('work_experience.update.form');
    Route::put('/work-experience/{id}', [WorkExperienceController::class, 'updateWorkExperience'])->name('work_experience.update');
    Route::delete('/work-experience/{id}', [WorkExperienceController::class, 'deleteWorkExperience'])->name('work_experience.delete');

});