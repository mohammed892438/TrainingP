<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\workExperienceRequests\deleteWorkExperienceRequest;
use App\Http\Requests\workExperienceRequests\getWorkExperienceForUser;
use App\Http\Requests\workExperienceRequests\storeWorkExperienceRequest;
use App\Http\Requests\workExperienceRequests\updateWorkExperienceRequest;
use App\Services\WorkExperienceService;
use Illuminate\Http\Request;

class WorkExperienceApiController extends Controller
{
    protected $workExperience;
    public function __construct(WorkExperienceService $workExperience)
    {
        $this->workExperience = $workExperience;
    }

    public function storeWorkExperience(storeWorkExperienceRequest $request){
        $validated = $request->validated();
        $response = $this->workExperience->storeWorkExperience($validated);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

    public function updateWorkExperience(updateWorkExperienceRequest $request , $id){
        $validated = $request->validated();
        $response = $this->workExperience->updateWorkExperience($validated , $id);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

    public function deleteWorkExperience(deleteWorkExperienceRequest $request , $id){
        $response = $this->workExperience->deleteWorkExperience($id);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }
    public function getWorkExperienceForUser(getWorkExperienceForUser $request){
        $response = $this->workExperience->getWorkExperienceForUser();
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }
}
