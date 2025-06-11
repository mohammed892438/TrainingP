<?php

namespace App\Services;

use App\Models\WorkExperience;
use Illuminate\Support\Facades\Auth;

class WorkExperienceService
{
    public function storeWorkExperience($data){
        try{
            $userId = Auth::id();
            $data['users_id'] = $userId;
            $workExperience = WorkExperience::create($data);
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data' => $workExperience
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }
    public function updateWorkExperience($data , $id){
        try{
            $workExperience = WorkExperience::findOrFail($id);
            $workExperience->update($data);
            return [
                'msg' => 'تم تعديل البيانات.',
                'success' => true,
                'data' => $workExperience
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function deleteWorkExperience($id){
        try{
            $workExperience = WorkExperience::findOrFail($id);
            $workExperience->delete();
            return [
                'msg' => 'تم مسح البيانات.',
                'success' => true,
                'data' => $workExperience
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }
    public function getWorkExperienceForUser(){
        try{
            $userId = Auth::id();
            $workExperience = WorkExperience::where('users_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $workExperience
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }
}
