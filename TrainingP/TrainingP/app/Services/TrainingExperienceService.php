<?php

namespace App\Services;

use App\Models\TrainingExperience;
use Illuminate\Support\Facades\Auth;

class TrainingExperienceService
{
    public function storeTrainingExperience($data){
        try{
            $userId = Auth::id();
            $data['trainer_id'] = $userId;
            $trainingExperience = TrainingExperience::create($data);
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data' => $trainingExperience
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function updateTrainingExperience($data , $id){
        try{
            $trainingExperience = TrainingExperience::findOrFail($id);
            $trainingExperience->update($data);
            return [
                'msg' => 'تم تعديل البيانات.',
                'success' => true,
                'data' => $trainingExperience
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }
    public function deleteTrainingExperience($id){
        try{
            $trainingExperience = TrainingExperience::findOrFail($id);
            $trainingExperience->delete();
            return [
                'msg' => 'تم مسح البيانات.',
                'success' => true,
                'data' => $trainingExperience
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function showTrainingExperience(){
        try{
            $userId = Auth::id();
            $trainingExperience = TrainingExperience::where('trainer_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $trainingExperience
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }
}

