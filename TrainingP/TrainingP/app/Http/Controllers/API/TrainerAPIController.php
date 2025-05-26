<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerRequests\completeRegisterRequest;
use App\Services\TrainerService;
use App\Helpers\ResponseJson;
use Illuminate\Http\Request;

class TrainerAPIController extends Controller
{
    protected $trainerService;
    public function __construct(TrainerService $trainerService)
    {
        $this->trainerService = $trainerService;
    }

    public function completeRegister(completeRegisterRequest $request , $id){
        $validated = $request->validated();
        $response = $this->trainerService->completeRegister($validated , $id);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

}
