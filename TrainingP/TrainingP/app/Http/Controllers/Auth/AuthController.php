<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use App\Helpers\ResponseJson;

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
}
