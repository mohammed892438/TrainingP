<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\VolunteeringRequests\showVolunteering;
use App\Http\Requests\VolunteeringRequests\storeVolunteering;
use App\Http\Requests\VolunteeringRequests\updateVolunteering;
use App\Models\ProvidedService;
use App\Models\Volunteering;
use App\Services\volunteeringService;
use Illuminate\Http\Request;

class VolunteeringController extends Controller
{
    protected $volunteeringService;

    public function __construct(volunteeringService $volunteeringService)
    {
        $this->volunteeringService = $volunteeringService;
    }

    public function index(showVolunteering $request)
    {
        $response = $this->volunteeringService->showVolunteering();
        return view('volunteerings.index', ['volunteerings' => $response['data']]);
    }


    public function create()
    {
        $providedServices= ProvidedService::all();

        return view('volunteerings.store', compact('providedServices'));
    }


    public function store(storeVolunteering $request)
    {
        $validated = $request->validated();
        $response = $this->volunteeringService->storeVolunteering($validated);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }


    public function edit(string $id)
    {
        $volunteering = Volunteering::findOrFail($id);
        $providedServices= ProvidedService::all();

        return view('volunteerings.update', compact('volunteering', 'providedServices'));
    }

    public function update(updateVolunteering $request, string $id)
    {
        $validated = $request->validated();
        $response = $this->volunteeringService->updateVolunteering($validated, $id);
        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function destroy(string $id)
    {
        $response = $this->volunteeringService->deleteVolunteering($id);
        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }
}
