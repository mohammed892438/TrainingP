<?php

namespace App\Services;

use App\Models\Volunteering;
use Illuminate\Support\Facades\Auth;

class volunteeringService
{

    public function showVolunteering(){
        try{
            $userId = Auth::id();
            $volunteering = Volunteering::where('users_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $volunteering
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function storeVolunteering($data){
        try{
            $userId = Auth::id();
            $data['users_id'] = $userId;

            if (isset($data['training_titles']) && is_string($data['training_titles'])) {
                $data['training_titles'] = array_map('trim', explode(',', $data['training_titles']));
            }

            $volunteering = Volunteering::create($data);
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data' => $volunteering
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function updateVolunteering($data , $id){
        try{
            $volunteering = Volunteering::findOrFail($id);

            if (isset($data['training_titles']) && is_string($data['training_titles'])) {
                $data['training_titles'] = array_map('trim', explode(',', $data['training_titles']));
            }

            $volunteering->update($data);
            return [
                'msg' => 'تم تعديل البيانات.',
                'success' => true,
                'data' => $volunteering
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function deleteVolunteering($id){
        try{
            $volunteering = Volunteering::findOrFail($id);
            $volunteering->delete();
            return [
                'msg' => 'تم مسح البيانات.',
                'success' => true,
                'data' => $volunteering
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