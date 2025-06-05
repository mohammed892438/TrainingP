<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingExperienceRequests\deleteTrainingExperience;
use App\Http\Requests\TrainingExperienceRequests\showTrainingExperience;
use App\Http\Requests\TrainingExperienceRequests\storeTrainingExperience;
use App\Http\Requests\TrainingExperienceRequests\updateTrainingExperience;
use App\Models\Country;
use App\Models\ProvidedService;
use App\Models\TrainingExperience;
use App\Services\TrainingExperienceService;
use Illuminate\Http\Request;

class TrainingExperienceController extends Controller
{
    protected $trainingExperience;

    public function __construct(TrainingExperienceService $trainingExperience)
    {
        $this->trainingExperience = $trainingExperience;
    }

    public function storeTrainingExperienceForm()
    {
        $providedServices = ProvidedService::all(); 
        $countries = Country::all(); 

        return view('training_experience.store', compact('providedServices', 'countries'));
    }
    public function updateTrainingExperienceForm($id)
    {
        $trainingExperience = TrainingExperience::findOrFail($id);
        $providedServices = ProvidedService::all(); 
        $countries = Country::all(); 

        return view('training_experience.update', compact('trainingExperience', 'providedServices', 'countries'));
    }
    public function storeTrainingExperience(storeTrainingExperience $request)
    {
        $validated = $request->validated();
        $response = $this->trainingExperience->storeTrainingExperience($validated);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function updateTrainingExperience(updateTrainingExperience $request, $id)
    {
        $validated = $request->validated();
        $response = $this->trainingExperience->updateTrainingExperience($validated, $id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function deleteTrainingExperience(deleteTrainingExperience $request, $id)
    {
        $response = $this->trainingExperience->deleteTrainingExperience($id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }

    public function showTrainingExperience(showTrainingExperience $request)
    {
        $response = $this->trainingExperience->showTrainingExperience();
        return view('training_experience.index', ['trainingExperiences' => $response['data']]);
    }
}