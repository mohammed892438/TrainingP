<?php
namespace App\Http\Controllers\User\CompletionData;

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

    public function index(showTrainingExperience $request)
    {
        $response = $this->trainingExperience->showTrainingExperience();
        return view('trainingExperience.index', ['trainingExperiences' => $response['data']]);
    }

    public function create()
    {
        $providedServices = ProvidedService::all();
        $countries = Country::all();

        return view('trainingExperience.store', compact('providedServices', 'countries'));
    }


    public function store(storeTrainingExperience $request)
    {
        $validated = $request->validated();
        $response = $this->trainingExperience->storeTrainingExperience($validated);

        if ($response['success']) {
            return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function edit($id)
    {
        $trainingExperience = TrainingExperience::findOrFail($id);
        $providedServices = ProvidedService::all();
        $countries = Country::all();

        return view('trainingExperience.update', compact('trainingExperience', 'providedServices', 'countries'));
    }

    public function update(updateTrainingExperience $request, $id)
    {
        $validated = $request->validated();
        $response = $this->trainingExperience->updateTrainingExperience($validated, $id);

        if ($response['success']) {
            return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function destroy(deleteTrainingExperience $request, $id)
    {
        $response = $this->trainingExperience->deleteTrainingExperience($id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }


}
