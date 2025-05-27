<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TraineeRequests\completeRegisterRequest;
use App\Services\TraineeService;
use App\Helpers\ResponseJson;
use Illuminate\Http\Request;

class TraineeAPIController extends Controller
{
    protected $traineeService;
    public function __construct(TraineeService $traineeService)
    {
        $this->traineeService = $traineeService;
    }

    public function completeRegister(completeRegisterRequest $request , $id){
        $validated = $request->validated();
        $response = $this->traineeService->completeRegister($validated , $id);

        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

}
