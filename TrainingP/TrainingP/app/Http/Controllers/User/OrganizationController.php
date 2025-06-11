<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequests\completeRegisterRequest;
use App\Http\Requests\OrganizationRequests\updateOrganizationProfile;
use App\Models\AnnualBudget;
use App\Models\Country;
use App\Models\EmployeeNumber;
use App\Models\Organization;
use App\Models\OrganizationSector;
use App\Models\OrganizationType;
use App\Models\User;
use App\Services\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function showRegistrationForm($id)
    {
        $user = User::findOrFail($id);
        $countries = Country::all();
        $organization_type = OrganizationType::all();
        $organization_sectors = OrganizationSector::all();
        $employee_number = EmployeeNumber::all();
        $annual_budget = AnnualBudget::all();


        return view('user.organization.complete-register-form',
        compact('user', 'countries', 'organization_type','organization_sectors', 'employee_number', 'annual_budget'));

    }

    public function completeRegister(completeRegisterRequest $request, $id)
{
    $validated = $request->validated();
    $response = $this->organizationService->completeRegister($validated, $id);

    if ($response['success'] == true) {
        return redirect()->route('homePageOrganization', ['id' => $id])->with('success', $response['msg']);
    } else {
        return back()->withErrors(['error' => $response['msg']]);
    }
}

public function show(Request $request)
{
    $response = $this->organizationService->getOrganizationForUser();
    if ($response['success']) {
        return sendResponse($response['data'], $response['msg']);
    } else {
        return sendError($response['msg']);
    }
}

public function showEditForm()
{
    $userId = Auth::id();
    $organization = Organization::where('id', $userId)->with('user')->firstOrFail();
    $countries = Country::all();
    $organization_type = OrganizationType::all();
    $organization_sectors = OrganizationSector::all();
    $employee_number = EmployeeNumber::all();
    $annual_budget = AnnualBudget::all();

    return view('organization.edit-register-form', compact(
        'organization',
        'countries',
        'organization_type',
        'organization_sectors',
        'employee_number',
        'annual_budget'
    ));
}

public function update(updateOrganizationProfile $request)
{
    $validated = $request->validated();
    $id = Auth::id();
    $response = $this->organizationService->updateOrganization($validated, $id);
    if ($response['success']) {
        return redirect()->route('homePageOrganization', ['id' => $response['data']['user']->id])
                        ->with('success', $response['msg']);
    } else {
        return back()->withErrors(['error' => $response['msg']]);
    }
}

}
