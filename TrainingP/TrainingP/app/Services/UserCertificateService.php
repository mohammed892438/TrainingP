<?php

namespace App\Services;

use App\Models\Certificate;
use App\Models\UserCertificate;
use Illuminate\Support\Facades\Auth;

class UserCertificateService
{
    public function storeUserCertificate($data){
        try{
            $userId = Auth::id();
            $data['user_id'] = $userId;
            $user_certificate = UserCertificate::create($data);
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data' => $user_certificate
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function updateUserCertificate($data , $id){
        try{
            $user_certificate = UserCertificate::findOrFail($id);
            $user_certificate->update($data);
            return [
                'msg' => 'تم تعديل البيانات.',
                'success' => true,
                'data' => $user_certificate
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function deleteUserCertificate($id){
        try{
            $user_certificate = UserCertificate::findOrFail($id);
            $user_certificate->delete();
            return [
                'msg' => 'تم مسح البيانات.',
                'success' => true,
                'data' => $user_certificate
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
}

    public function showUserCertificate(){
        try{
            $userId = Auth::id();
            $user_certificate = UserCertificate::where('user_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $user_certificate
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

