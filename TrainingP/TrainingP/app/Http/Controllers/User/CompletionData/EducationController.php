<?php
namespace App\Http\Controllers\User\CompletionData;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationRequests\deleteEducation;
use App\Http\Requests\EducationRequests\showEducation;
use App\Http\Requests\EducationRequests\storeEducation;
use App\Http\Requests\EducationRequests\updateEducation;
use App\Models\Education;
use App\Models\EducationLevel;
use App\Models\Language;
use App\Services\EducationService;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    protected $EducationService;

    public function __construct(EducationService $EducationService)
    {
        $this->EducationService = $EducationService;
    }

    public function index(showEducation $request)
    {
        $response = $this->EducationService->showEducation();
        return view('education.index', ['educations' => $response['data']]);
    }

    public function create()
    {
        $educationlevels = EducationLevel::all();
        $languages = Language::all();

        return view('education.store', compact('educationlevels', 'languages'));
    }


    public function store(storeEducation $request)
    {
        $validated = $request->validated();
        $response = $this->EducationService->storeEducation($validated);

        if ($response['success']) {
            return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function edit($id)
    {
        $education = Education::findOrFail($id);
        $educationlevels = EducationLevel::all();
        $languages = Language::all();

        return view('education.update', compact('education', 'educationlevels', 'languages'));
    }

    public function update(updateEducation $request, $id)
    {
        $validated = $request->validated();
        $response = $this->EducationService->updateEducation($validated, $id);

        if ($response['success']) {
            return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function destroy(deleteEducation $request, $id)
    {
        $response = $this->EducationService->deleteEducation($id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }


}
