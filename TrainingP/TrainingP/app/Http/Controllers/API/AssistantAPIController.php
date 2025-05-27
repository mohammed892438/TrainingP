<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssistantRequests\completeRegisterRequest;
use App\Services\AssistantService;
use App\Helpers\ResponseJson;
use Illuminate\Http\Request;

class AssistantAPIController extends Controller
{
    protected $AssistantService;
    public function __construct(AssistantService $AssistantService)
    {
        $this->AssistantService = $AssistantService;
    }

    public function completeRegister(completeRegisterRequest $request , $id){
        $validated = $request->validated();
        $response = $this->AssistantService->completeRegister($validated , $id);

        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

}
