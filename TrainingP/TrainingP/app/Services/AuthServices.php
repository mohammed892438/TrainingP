<?php

namespace App\Services;

use App\Mail\CompleteProfileMail;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class AuthServices
{
    public function register($data)
{
    try {
        $data['password'] = Hash::make($data['password']); 
        $user = User::create($data);
        $user->save();

        $userType = UserType::findOrFail($data['user_type_id']);

        switch ($userType->name) {
            case 'مدرب':
                $link = route('complete-trainer-register', ['id' => $user->id]);
                break;
            case 'مساعد':
                $link = route('complete-assistant-register', ['id' => $user->id]);
                break;
            case 'متدرب':
                $link = route('complete-trainee-register', ['id' => $user->id]);
                break;
            case 'مؤسسة':
                $link = route('complete-organization-register', ['id' => $user->id]);
                break;
            default:
                $link = null;
        }

        if ($link) {
            Mail::to($user->email)->send(new CompleteProfileMail($link));
        }

        return [
            'msg' => 'تم إنشاء الحساب بنجاح. تحقق من بريدك الإلكتروني لإكمال ملفك الشخصي.',
            'success' => true,
            'data' => $user
        ];
    } catch (\Exception $e) {
        return [
            'msg' => $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}
}
