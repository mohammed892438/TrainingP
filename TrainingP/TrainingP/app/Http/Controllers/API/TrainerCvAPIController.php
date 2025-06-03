<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerCvRequests\deleteCvRequest;
use App\Http\Requests\TrainerCvRequests\getYourCvRequest;
use App\Services\TrainerCvService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerCvAPIController extends Controller
{
    protected $trainerCvService;
    public function __construct(TrainerCvService $trainerCvService)
    {
        $this->trainerCvService = $trainerCvService;
    }
    public function uploadCv(Request $request)
    {
        $response =  $this->trainerCvService->UploadTrainerCv($request);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

    public function getYourCv(getYourCvRequest $request)
    {
        $response = $this->trainerCvService->getYourCv();
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

    public function updateCv(Request $request, $id)
    {
        $response = $this->trainerCvService->updateCv($request, $id);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

    public function deleteCv(deleteCvRequest $request)
    {
        $userId = Auth::id();
        $response = $this->trainerCvService->deleteCv($userId);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

}
