<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\ChallengeAndProblemController;
use App\Http\Controllers\User\CommitmentController;
use App\Http\Controllers\User\partnershipController;
use App\Http\Controllers\User\SkillController;
use App\Http\Controllers\User\UserCertificateController;
use App\Http\Controllers\User\AssistantController;
use App\Http\Controllers\User\CollaborationController;
use App\Http\Controllers\User\EducationController;
use App\Http\Controllers\User\GoalController;
use App\Http\Controllers\User\OrganizationController;
use App\Http\Controllers\User\PortfolioController;
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\User\TraineeController;
use App\Http\Controllers\User\TrainerController;
use App\Http\Controllers\User\TrainerCvController;
use App\Http\Controllers\User\TrainingExperienceController;
use App\Http\Controllers\User\VolunteeringController;
use App\Http\Controllers\User\WorkEnvironmentController;
use App\Http\Controllers\User\WorkExperienceController;
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

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if (is_null($user->email_verified_at)) {
            return redirect()->route('verify-user-blade', ['id' => $user->id])->with('msg', 'يرجى التحقق من بريدك الإلكتروني.');
        }
        $routes = [
            1 => 'complete-trainer-register',
            2 => 'complete-assistant-register',
            3 => 'complete-trainee-register',
            4 => 'complete-organization-register',
        ];

        $profileExists = false;
        switch ($user->user_type_id) {
            case 1: // Trainer
                $profileExists = Trainer::where('id', $user->id)->exists();
                break;
            case 2: // Assistant
                $profileExists = Assistant::where('id', $user->id)->exists();
                break;
            case 3: // Trainee
                $profileExists = Trainee::where('id', $user->id)->exists();
                break;
            case 4: // Organization
                $profileExists = Organization::where('id', $user->id)->exists();
                break;
            default:
                return redirect('/')->with('msg', 'نوع المستخدم غير معروف.');
        }

        if (!$profileExists) {
            $routeName = $routes[$user->user_type_id] ?? 'home';
            return redirect()->route($routeName, ['id' => $user->id]);
        }
        if ($user->user_type_id == 4) {
            return redirect()->route('homePageOrganization'); 
        }

        return redirect()->route('homePage');

    }

    return view('index'); 
});
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

});



require __DIR__.'/front_fetch.php';
