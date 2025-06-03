<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\logoutRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Http\Requests\AuthRequests\verfiyRequest;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use App\Helpers\ResponseJson;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }

    public function RegisterView()
{
    return view('auth.register');
}


public function register(RegisterRequest $request)
{
    $validated = $request->validated();
    $response = $this->authService->register($validated);

    if ($response['success']) {
        return redirect()->route('verify-user-blade', ['id' => $response['data']->id])->with('success', $response['msg']);
    }

    return back()->withInput()->withErrors(['error' => $response['msg']]);
}


public function verifyUserView($id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('register')->withErrors(['error' => 'User not found!']);
    }

    return view('auth.verify-user', compact('user'));
}


public function verifyUser($id)
{
    $result = $this->authService->verifyUser($id);

    if ($result['success']) {
        return redirect($result['data']['link'])->with('success', $result['msg']);
    } else {
        return redirect()->route('verify-user-blade', ['id' => $id])->withErrors(['error' => $result['msg']]);

    }
}

public function resendVerificationEmail(verfiyRequest $request, $id)
{
    $result = $this->authService->resendVerificationEmail($id);

    if (!$result['success']) {
        return back()->withErrors(['error' => $result['msg']]);
    }

    return back()->with('success', $result['msg']);
}


public function showLoginForm()
{
    return view('auth.login');
}

public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $response = $this->authService->login($validated);

        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

    public function logout(logoutRequest $request)
    {
        $response = $this->authService->logout();
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }
   


}
