<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\Organization\ChallengeAndProblemController;
use App\Http\Controllers\User\Organization\CommitmentController;
use App\Http\Controllers\User\Organization\OrganizationProfileController;
use App\Http\Controllers\User\partnershipController;
use App\Http\Controllers\User\CompletionData\SkillController;
use App\Http\Controllers\User\CompletionData\UserCertificateController;
use App\Http\Controllers\User\Assistant\AssistantController;
use App\Http\Controllers\User\Organization\CollaborationController;
use App\Http\Controllers\User\CompletionData\EducationController;
use App\Http\Controllers\User\Organization\GoalController;
use App\Http\Controllers\User\Organization\OrganizationController;
use App\Http\Controllers\User\CompletionData\PortfolioController;
use App\Http\Controllers\User\CompletionData\ServiceController;
use App\Http\Controllers\User\Trainee\TraineeController;
use App\Http\Controllers\User\Trainer\TrainerProfileController;
use App\Http\Controllers\User\Trainer\TrainerController;
use App\Http\Controllers\User\CompletionData\TrainerCvController;
use App\Http\Controllers\User\CompletionData\TrainingExperienceController;
use App\Http\Controllers\User\CompletionData\VolunteeringController;
use App\Http\Controllers\User\CompletionData\WorkExperienceController;
use App\Models\Assistant;
use App\Models\Goal;
use App\Models\Organization;
use App\Models\Trainee;
use App\Models\Trainer;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// User Route - Adjusted for Session Authentication
Route::get('/user', function (Request $request) {
    return Auth::user();
})->middleware('auth');

Route::get('/', [HomeController::class, 'index']);

//home page
Route::get('/homePage', [AuthController::class, 'View'])->name('homePage');
Route::get('/homePageOrganization', [AuthController::class, 'ViewOrganization'])->name('homePageOrganization');

// Auth Controller Routes
Route::get('/register', [AuthController::class, 'RegisterView'])->name('register');
Route::get('/register-org', [AuthController::class, 'RegisterViewOrganization'])->name('register-org');
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
Route::middleware(['auth:web','CheckEmailVerified'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    //trainer cv
    Route::resource('trainerCv',TrainerCvController::class);

    //training experience
    Route::resource('trainingExperience',TrainingExperienceController::class);

    //work experience
    Route::resource('workExperience',WorkExperienceController::class);

    //education
    Route::resource('education',EducationController::class);

    //certificate
    Route::resource('userCertificates',UserCertificateController::class);

    //portfolio
    Route::resource('portfolio',PortfolioController::class);

    //skill controller
    Route::resource('skills',SkillController::class);

    //services
    Route::resource('services',ServiceController::class);

    //volunteering
    Route::resource('volunteerings',VolunteeringController::class);

    //goals
    Route::resource('goals',GoalController::class);

    //challenge and problems
    Route::resource('challengeAndProblems',ChallengeAndProblemController::class);

    //commitments controller
    Route::resource('commitments', CommitmentController::class);

    //Collaboration
    Route::resource('collaborations', CollaborationController::class);

    //organization profile
    Route::get('/organization/profile', [OrganizationProfileController::class, 'showOrganizationProfile'])->name('organization.profile');

    //trainer profile
    Route::get('/show-trainer-profile' , [TrainerProfileController::class , 'showProfile'])->name('show_trainer_profile');
    Route::get('/edit-trainer-profile' , [TrainerProfileController::class , 'editProfile'])->name('edit_trainer_profile');
    Route::put('/update-trainer-profile' , [TrainerProfileController::class , 'updateProfile'])->name('update_trainer_profile');


    //update on organzation profile
    Route::get('organization/edit', [OrganizationController::class, 'showEditForm'])->name('organization.edit');
    Route::put('organization/update', [OrganizationController::class, 'update'])->name('organization.update');
});



require __DIR__.'/front_fetch.php';
