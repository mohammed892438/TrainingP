<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\workExperienceRequests\deleteWorkExperienceRequest;
use App\Http\Requests\workExperienceRequests\getWorkExperienceForUser;
use App\Http\Requests\workExperienceRequests\storeWorkExperienceRequest;
use App\Http\Requests\workExperienceRequests\updateWorkExperienceRequest;
use App\Models\WorkExperience;
use App\Services\WorkExperienceService;
use Illuminate\Http\Request;
use App\Models\Country; 

class WorkExperienceController extends Controller
{
    protected $workExperience;

    public function __construct(WorkExperienceService $workExperience)
    {
        $this->workExperience = $workExperience;
    }
    public function index()
    {
        $workExperiences = WorkExperience::where('users_id', auth()->id())->get(); 
        return view('work_experience.index', compact('workExperiences'));
    }

    public function storeWorkExperienceForm()
    {
        $countries = Country::all(); 
        return view('work_experience.store', compact('countries'));
    }

    public function updateWorkExperienceForm($id)
    {
        $workExperience = WorkExperience::findOrFail($id);
        $countries = Country::all(); 
        return view('work_experience.update', compact('workExperience', 'countries'));
    }

    public function storeWorkExperience(storeWorkExperienceRequest $request)
    {
        $validated = $request->validated();
        $response = $this->workExperience->storeWorkExperience($validated);
        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function updateWorkExperience(updateWorkExperienceRequest $request, $id)
    {
        $validated = $request->validated();
        $response = $this->workExperience->updateWorkExperience($validated, $id);
        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function deleteWorkExperience(deleteWorkExperienceRequest $request, $id)
    {
        $response = $this->workExperience->deleteWorkExperience($id);
        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }

    public function getWorkExperienceForUser(getWorkExperienceForUser $request)
    {
        $response = $this->workExperience->getWorkExperienceForUser();
        if ($response['success']) {
            return sendResponse($response['data'], $response['msg']);
        } else {
            return sendError($response['msg']);
        }
    }
}