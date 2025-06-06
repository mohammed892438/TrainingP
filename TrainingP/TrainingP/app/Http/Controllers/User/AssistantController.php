<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssistantRequests\completeRegisterRequest;
use App\Models\Country;
use App\Models\EducationLevel;
use App\Models\ExperienceArea;
use App\Models\Language;
use App\Models\ProvidedService;
use App\Models\User;
use App\Services\AssistantService;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    protected $assistantService;

    public function __construct(AssistantService $assistantService)
    {
        $this->assistantService = $assistantService;
    }

    public function showRegistrationForm($id)
    {
        $user = User::findOrFail($id);
        $countries = Country::all();
        $services = ProvidedService::all();
        $experience_areas = ExperienceArea::all();
        $nationalities = Country::all();
        $education_levels = EducationLevel::all();
        $languages = Language::all();

        return view('user.assistant.complete-register-form',
        compact('user', 'countries', 'services','experience_areas', 'nationalities' , 'education_levels', 'languages'));

    }

    public function completeRegister(completeRegisterRequest $request , $id){
        $validated = $request->validated();
        // dd($validated);
        $response = $this->assistantService->completeRegister($validated , $id);

        if ($response['success'] == true) {
            return redirect()->route('users_landing', ['id' => $id])->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }

    public function showUsersLanding($id){
        $user = User::findOrFail($id);

        return view('user.landing',compact('user'));
    }

}
