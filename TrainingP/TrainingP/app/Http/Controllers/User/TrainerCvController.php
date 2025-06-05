<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerCvRequests\deleteCvRequest;
use App\Http\Requests\TrainerCvRequests\getYourCvRequest;
use App\Models\TrainerCv;
use App\Services\TrainerCvService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerCvController extends Controller
{
    protected $trainerCvService;
    public function __construct(TrainerCvService $trainerCvService)
    {
        $this->trainerCvService = $trainerCvService;
    }

    public function showCvForm()
    {
        return view('trainer_cv.form');
    }
    public function showCvView()
    {
        $response = $this->trainerCvService->getYourCv();
        return view('trainer_cv.view', ['cv' => $response['data']]);
    }
    public function showUpdateForm($id)
    {
        $cv = TrainerCv::findOrFail($id); 
        return view('trainer_cv.update', ['cv' => $cv]);
    }
    public function redirectToCvForm()
    {
        return redirect()->route('trainer.cv.form');
    }

    public function uploadCv(Request $request)
{
    $response = $this->trainerCvService->UploadTrainerCv($request);
    if ($response['success'] == true) {
        return redirect()->route('homePage')->with('success', $response['msg']);
    } else {
        return back()->withErrors(['error' => $response['msg']]);
    }
}

public function getYourCv(getYourCvRequest $request)
{
    $response = $this->trainerCvService->getYourCv();
    if ($response['success'] == true) {
        return view('trainer_cv.view', ['cv' => $response['data'], 'msg' => $response['msg']]);
    } else {
        return back()->withErrors(['error' => $response['msg']]);
    }
}

public function updateCv(Request $request, $id)
{
    $response = $this->trainerCvService->updateCv($request, $id);
    if ($response['success'] == true) {
        return redirect()->route('homePage')->with('success', $response['msg']);
    } else {
        return back()->withErrors(['error' => $response['msg']]);
    }
}

public function deleteCv(deleteCvRequest $request)
{
    $userId = Auth::id();
    $response = $this->trainerCvService->deleteCv($userId);
    if ($response['success'] == true) {
        return redirect()->route('homePage')->with('success', $response['msg']);
    } else {
        return back()->withErrors(['error' => $response['msg']]);
    }
}

}
