<?php

namespace App\Services;

use App\Mail\CompleteProfileMail;
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

        $link = url("/complete-profile?user_id={$user->id}");

        Mail::to($user->email)->send(new CompleteProfileMail($link));

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
