<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingExperienceRequests\deleteTrainingExperience;
use App\Http\Requests\TrainingExperienceRequests\showTrainingExperience;
use App\Http\Requests\TrainingExperienceRequests\storeTrainingExperience;
use App\Http\Requests\TrainingExperienceRequests\updateTrainingExperience;
use App\Services\TrainingExperienceService;
use Illuminate\Http\Request;

class TrainingExperienceApiController extends Controller
{
    protected $trainingExperience;
    public function __construct(TrainingExperienceService $trainingExperience)
    {
        $this->trainingExperience = $trainingExperience;
    }
    public function storeTrainingExperience(storeTrainingExperience $request){
        $validated = $request->validated();
        $response = $this->trainingExperience->storeTrainingExperience($validated);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

    public function updateTrainingExperience(updateTrainingExperience $request , $id){
        $validated = $request->validated();
        $response = $this->trainingExperience->updateTrainingExperience($validated , $id);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }
    public function deleteTrainingExperience(deleteTrainingExperience $request , $id){
        $response = $this->trainingExperience->deleteTrainingExperience($id);
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

    public function showTrainingExperience(showTrainingExperience $request){
        $response = $this->trainingExperience->showTrainingExperience();
        if($response['success'] == true){
            return sendResponse($response['data'] , $response['msg']);
        }
        else{
            return sendError($response['msg']);
        }
    }

}
