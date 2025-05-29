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

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $response = $this->authService->register($validated);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }
    public function verifyUser(verfiyRequest $request , $id)
{
    $result = $this->authService->verifyUser($id);

    if ($result['success']) {
        return sendResponse( $result['data'] , $result['msg'] );
    } else {
        return sendError( $result['msg'] );
    }
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
    public function resendVerificationEmail(verfiyRequest $request , $id)
{
    $result = $this->authService->resendVerificationEmail($id);

    if ($result['success']) {
        return sendResponse( $result['data'] , $result['msg'] );
    } else {
        return sendError( $result['msg'] );
    }
}


}
