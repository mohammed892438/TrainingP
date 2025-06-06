<?php

namespace App\Services;

use App\Models\Education;
use Illuminate\Support\Facades\Auth;

class EducationService
{
    public function storeEducation($data){
        try{
            $userId = Auth::id();
            $data['user_id'] = $userId;
            $education = Education::create($data);
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data' => $education
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function updateEducation($data , $id){
        try{
            $education = Education::findOrFail($id);
            $education->update($data);
            return [
                'msg' => 'تم تعديل البيانات.',
                'success' => true,
                'data' => $education
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function deleteEducation($id){
        try{
            $education = Education::findOrFail($id);
            $education->delete();
            return [
                'msg' => 'تم مسح البيانات.',
                'success' => true,
                'data' => $education
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function showEducation(){
        try{
            $userId = Auth::id();
            $education = education::where('user_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $education
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

