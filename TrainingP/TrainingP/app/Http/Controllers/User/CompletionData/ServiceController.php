<?php

namespace App\Http\Controllers\User\CompletionData;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequests\deleteService;
use App\Http\Requests\ServiceRequests\showService;
use App\Http\Requests\ServiceRequests\storeService;
use App\Http\Requests\ServiceRequests\updateService;
use App\Models\Service;
use App\Models\WorkExperience;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index(showService $request)
    {
        $response = $this->serviceService->showService();
        return view('services.index', ['services' => $response['data']]);
    }


    public function create()
    {
        $workExperience = WorkExperience::all();

        return view('services.store', compact('workExperience'));
    }


    public function store(storeService $request)
    {
        $validated = $request->validated();
        $response = $this->serviceService->storeService($validated);

        if ($response['success']) {
            return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }


    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        $workExperience = WorkExperience::all();

        return view('services.update', compact('service', 'workExperience'));
    }


    public function update(updateService $request, string $id)
    {
        $validated = $request->validated();
        $response = $this->serviceService->updateService($validated, $id);
        if ($response['success']) {
            return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }


    public function destroy(deleteService $request, $id)
    {
        $response = $this->serviceService->deleteService($id);
        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }
}
