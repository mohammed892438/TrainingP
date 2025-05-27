<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequests\completeRegisterRequest;
use App\Services\OrganizationService;
use App\Helpers\ResponseJson;
use Illuminate\Http\Request;

class OrganizationAPIController extends Controller
{
    protected $OrganizationService;
    public function __construct(OrganizationService $OrganizationService)
    {
        $this->OrganizationService = $OrganizationService;
    }

    public function completeRegister(completeRegisterRequest $request , $id){
        $validated = $request->validated();
        $response = $this->OrganizationService->completeRegister($validated , $id);

        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

}
