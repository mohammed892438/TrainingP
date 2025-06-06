<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCertificateRequests\deleteUserCertificate;
use App\Http\Requests\UserCertificateRequests\showUserCertificate;
use App\Http\Requests\UserCertificateRequests\storeUserCertificate;
use App\Http\Requests\UserCertificateRequests\updateUserCertificate;
use App\Models\Certificate;
use App\Models\UserCertificate;
use App\Services\UserCertificateService;
use Illuminate\Http\Request;

class UserCertificateController extends Controller
{
    protected $UserCertificateService;

    public function __construct(UserCertificateService $UserCertificateService)
    {
        $this->UserCertificateService = $UserCertificateService;
    }

    public function index(showUserCertificate $request)
    {
        $response = $this->UserCertificateService->showUserCertificate();
        return view('user_certificate.index', ['userCertificates' => $response['data']]);
    }

    public function create()
    {
        $certificates = Certificate::all();

        return view('user_certificate.store', compact('certificates'));
    }


    public function store(storeUserCertificate $request)
    {
        $validated = $request->validated();
        $response = $this->UserCertificateService->storeUserCertificate($validated);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function edit($id)
    {
        $userCertificate = UserCertificate::findOrFail($id);
        $certificates = Certificate::all();

        return view('user_certificate.update', compact('userCertificate', 'certificates'));
    }

    public function update(updateUserCertificate $request, $id)
    {
        $validated = $request->validated();
        $response = $this->UserCertificateService->updateUserCertificate($validated, $id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function destroy(deleteUserCertificate $request, $id)
    {
        $response = $this->UserCertificateService->deleteUserCertificate($id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }


}
