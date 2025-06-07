<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceService
{

    public function showService(){
        try{
            $userId = Auth::id();
            $service = Service::where('users_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $service
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function storeService($data){
        try{
            $userId = Auth::id();
            $data['users_id'] = $userId;

            if (isset($data['training_areas']) && is_string($data['training_areas'])) {
                $data['training_areas'] = array_map('trim', explode(',', $data['training_areas']));
            }

            $service = Service::create($data);
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data' => $service
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }
    public function updateService($data , $id){
        try{
            $service = Service::findOrFail($id);

            if (isset($data['training_areas']) && is_string($data['training_areas'])) {
                $data['training_areas'] = array_map('trim', explode(',', $data['training_areas']));
            }
            
            $service->update($data);
            return [
                'msg' => 'تم تعديل البيانات.',
                'success' => true,
                'data' => $service
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function deleteService($id){
        try{
            $service = Service::findOrFail($id);
            $service->delete();
            return [
                'msg' => 'تم مسح البيانات.',
                'success' => true,
                'data' => $service
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