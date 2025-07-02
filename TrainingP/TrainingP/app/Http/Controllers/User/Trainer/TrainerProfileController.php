<?php

namespace App\Http\Controllers\User\Trainer;

use App\Enums\SexEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerRequests\profilePhoto;
use App\Http\Requests\TrainerRequests\updateContactInfo;
use App\Http\Requests\TrainerRequests\updateExperiance;
use App\Http\Requests\TrainerRequests\updatePersonalInfo;
use App\Models\Country;
use App\Models\ProvidedService;
use App\Models\Trainer;
use App\Models\User;
use App\Models\WorkField;
use App\Models\WorkSector;
use App\Services\TrainerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerProfileController extends Controller
{
    protected $trainerService;

  public function __construct(TrainerService $trainerService)
  {
    $this->trainerService = $trainerService;
  }

    public function showProfile()
{
    $id = Auth::id();
    $user = User::with('country')->findOrFail($id);
    $trainer = Trainer::where('id', $id)->firstOrFail();
    $sexs = SexEnum::cases();
    $work_sectors = WorkSector::all();
    $provided_services = ProvidedService::all();
    $work_fields = WorkField::all();
    $countries = Country::all();

    $trainer_providedServices = ProvidedService::whereIn('id', $trainer->provided_services ?? [])->get();

    $trainer_workSectors = WorkSector::whereIn('id', $trainer->work_sectors ?? [])->get();

    $trainer_workFields = WorkField::whereIn('id', $trainer->work_fields ?? [])->get();

    $trainer_importantTopics = $trainer->important_topics ?? [];

    return view('user.trainer.show_profile',compact('user','trainer','providedServices','workSectors','workFields'));
}



public function updatePersonalInfo(updatePersonalInfo $request){

    $data = $request->validated();

    $response = $this->trainerService->updatePersonalInfo($data);

    if ($response['success'] == true) {
      return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
    } else {
      return back()->withErrors(['error' => $response['msg']]);
    }
}


public function updateExperiance(updateExperiance $request){

    $data = $request->validated();

    $response = $this->trainerService->updateExperiance($data);

    if ($response['success'] == true) {
      return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
    } else {
      return back()->withErrors(['error' => $response['msg']]);
    }
}


public function updateContactinfo(updateContactInfo $request){

    $data = $request->validated();

    $response = $this->trainerService->updateContactinfo($data);

    if ($response['success'] == true) {
      return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
    } else {
      return back()->withErrors(['error' => $response['msg']]);
    }
}

}
