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


    public function index()
    {
        $response = $this->trainerCvService->getYourCv();
        return view('trainerCv.index', ['cv' => $response['data']]);
    }

    public function create()
    {
        return view('trainerCv.store');
    }


    // public function redirectToCvForm()
    // {
    //     return redirect()->route('trainerCv.form');
    // }

    public function store(Request $request)
{
    $response = $this->trainerCvService->UploadTrainerCv($request);
    if ($response['success'] == true) {
        return redirect()->route('homePage')->with('success', $response['msg']);
    } else {
        return back()->withErrors(['error' => $response['msg']]);
    }
}

public function edit($id)
{
    $cv = TrainerCv::findOrFail($id);
    return view('trainerCv.update', ['cv' => $cv]);
}

public function show(getYourCvRequest $request)
{
    $response = $this->trainerCvService->getYourCv();
    if ($response['success'] == true) {
        return view('trainerCv.index', ['cv' => $response['data'], 'msg' => $response['msg']]);
    } else {
        return back()->withErrors(['error' => $response['msg']]);
    }
}

public function update(Request $request, $id)
{
    $response = $this->trainerCvService->updateCv($request, $id);
    if ($response['success'] == true) {
        return redirect()->route('homePage')->with('success', $response['msg']);
    } else {
        return back()->withErrors(['error' => $response['msg']]);
    }
}

public function destroy(deleteCvRequest $request)
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
