<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Services\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }
    public function login(logInRequest $request)
    {
        $validated = $request->validated();
        $response = $this->authService->login($validated['identifier'], $validated['password']);
        return response()->json($response);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $response = $this->authService->register($validated);
        return response()->json($response);
    }
}
