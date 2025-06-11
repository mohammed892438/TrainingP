<?php

namespace App\Http\Controllers\User\Trainer;

use App\Enums\SexEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerRequests\updateProfile;
use App\Models\Country;
use App\Models\ProvidedService;
use App\Models\Trainer;
use App\Models\User;
use App\Models\WorkField;
use App\Models\WorkSector;
use App\Services\EducationService;
use App\Services\PortfolioService;
use App\Services\ServiceService;
use App\Services\SkillService;
use App\Services\TrainerCvService;
use App\Services\TrainerService;
use App\Services\TrainingExperienceService;
use App\Services\UserCertificateService;
use App\Services\volunteeringService;
use App\Services\WorkExperienceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerProfileController extends Controller
{
    protected $workExperience, $EducationService , $UserCertificateService , $skillService , $volunteeringService ,
    $trainingExperience ,  $portfolioService , $serviceService , $trainerCvService , $trainerService;

    public function __construct(EducationService $EducationService , WorkExperienceService $workExperience ,
    UserCertificateService $UserCertificateService , SkillService $skillService ,volunteeringService $volunteeringService ,
    TrainingExperienceService $trainingExperience , PortfolioService $portfolioService , ServiceService $serviceService ,
    TrainerCvService $trainerCvService , TrainerService $trainerService)
    {
        $this->EducationService = $EducationService;
        $this->workExperience = $workExperience;
        $this->UserCertificateService = $UserCertificateService;
        $this->skillService = $skillService;
        $this->volunteeringService = $volunteeringService;
        $this->trainingExperience = $trainingExperience;
        $this->portfolioService = $portfolioService;
        $this->serviceService = $serviceService;
        $this->trainerCvService = $trainerCvService;
        $this->trainerService = $trainerService;
    }


    public function showProfile()
{
    $id = Auth::id();

    $user = User::with('country')->findOrFail($id);

    $trainer = Trainer::where('id', $id)->firstOrFail();

    $providedServices = ProvidedService::whereIn('id', $trainer->provided_services ?? [])->get();

    $importantTopics = $trainer->important_topics ?? [];

    $workSectors = WorkSector::whereIn('id', $trainer->work_sectors ?? [])->get();

    $response1 = $this->workExperience->getWorkExperienceForUser();
    $workexperiences = $response1['data'] ?? [];

    $response2 = $this->EducationService->showEducation();
    $educations = $response2['data'] ?? [];

    $response3 = $this->UserCertificateService->showUserCertificate();
    $Certificates = $response3['data'] ?? [];

    $response4 = $this->volunteeringService->showVolunteering();
    $volunteerings = $response4['data'] ?? [];

    $response5 = $this->trainingExperience->showTrainingExperience();
    $trainingexperiences = $response5['data'] ?? [];

    $response6 = $this->portfolioService->showPortfolio();
    $Portfolios = $response6['data'] ?? [];

    $response7 = $this->serviceService->showService();
    $services = $response7['data'] ?? [];

    $response8 = $this->skillService->showSkill();
    $skills = $response8['data'] ?? [];

    $response9 = $this->trainerCvService->getYourCv();
    $trainercv = $response9['data'] ?? [];



    return view('user.trainer.show_profile', compact('user', 'trainer' , 'workexperiences' , 'educations' , 'Certificates' ,
    'volunteerings' , 'trainingexperiences' , 'Portfolios' , 'services' ,'skills' , 'providedServices' , 'workSectors' ,
    'importantTopics' , 'trainercv' ));
}

public function editProfile(){
    $id = Auth::id();

    $user = User::with('country')->findOrFail($id);

    $trainer = Trainer::where('id', $id)->firstOrFail();

    $sexs = SexEnum::cases();

    $nationalities = Country::all();

    $workSectors = WorkSector::all();

    $providedServices = ProvidedService::all();

    $workFields = WorkField::all();

    $importantTopics = $trainer->important_topics ?? [];

    return view('user.trainer.update_profile', compact('user', 'trainer' , 'nationalities' , 'workSectors' , 'providedServices' ,
    'workFields' , 'importantTopics' , 'sexs' ));

}

public function updateProfile(updateProfile $request){

    $validated = $request->validated();

    $response = $this->trainerService->updateProfil($validated);

    if ($response['success'] == true) {
      return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
    } else {
      return back()->withErrors(['error' => $response['msg']]);
    }
}

}
