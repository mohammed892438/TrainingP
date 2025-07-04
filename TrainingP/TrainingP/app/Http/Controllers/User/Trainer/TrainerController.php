<?php

namespace App\Http\Controllers\User\Trainer;

use App\Enums\SexEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerRequests\completeRegisterRequest;
use App\Models\Country;
use App\Models\ProvidedService;
use App\Models\User;
use App\Models\WorkField;
use App\Models\WorkSector;
use App\Services\TrainerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TrainerController extends Controller
{
  protected $trainerService;

  public function __construct(TrainerService $trainerService)
  {
    $this->trainerService = $trainerService;
  }

  public function showRegistrationForm($id)
  {
    $user = User::findOrFail($id);
    $countries = Country::all();
    $nationalities = Country::all();
    $sexs = SexEnum::cases();
    $work_sectors = WorkSector::all();
    $provided_services = ProvidedService::all();
    $work_fields = WorkField::all();

    return view(
      'user.trainer.complete-register-form',
      compact('user', 'countries', 'nationalities', 'sexs', 'work_sectors', 'provided_services', 'work_fields')
    );

  }

  public function completeRegister(completeRegisterRequest $request, $id)
  {
    $validated = $request->validated();

    $response = $this->trainerService->completeRegister($validated, $id);

    if ($response['success'] == true) {
      return redirect()->route('homePage', ['id' => $id])->with('success', $response['msg']);
    } else {
      return back()->withErrors(['error' => $response['msg']]);
    }
  }


}
