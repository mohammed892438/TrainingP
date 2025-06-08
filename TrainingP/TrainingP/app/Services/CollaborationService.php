<?php

namespace App\Services;

use App\Models\Collaboration;
use Illuminate\Support\Facades\Auth;

class CollaborationService {

    public function showcollaborations(){
        try{
            $userId = Auth::id();
            $collaborations = Collaboration::where('organizations_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $collaborations
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function storecollaboration($data){
        try{
            $userId = Auth::id();
            $data['organizations_id'] = $userId;
            $collaboration = Collaboration::create($data);
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data' => $collaboration
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function updatecollaboration($data , $id){
        try{
            $collaboration = Collaboration::findOrFail($id);
            $collaboration->update($data);
            return [
                'msg' => 'تم تعديل البيانات.',
                'success' => true,
                'data' => $collaboration
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function deletecollaboration($id){
        try{
            $collaboration = Collaboration::findOrFail($id);
            $collaboration->delete();
            return [
                'msg' => 'تم مسح البيانات.',
                'success' => true,
                'data' => $collaboration
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