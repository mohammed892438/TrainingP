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

        $link = route('verify-user', ['id' => $user->id]);

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

public function verifyUser($id)
{
    try {
        $user = User::findOrFail($id);
        $user->email_verified_at = now();
        $user->save();

        $userType = UserType::findOrFail($user->user_type_id);
        dd( $userType);

        switch ($userType->id) {
            case 1:
                route('complete-trainer-register', ['id' => $id]);
                break;
            case 3:
                 route('complete-trainee-register', ['id' => $id]);
                break;
            case 2:
                route('complete-assistant-register', ['id' => $id]);
                break;
            case 4:
                route('complete-organization-register', ['id' => $id]);
                break;
        }

        return [
            'msg' => 'تم التحقق من الحساب بنجاح .',
            'success' => true,
            'data' => $user,
        ];
    } catch (\Exception $e) {
        return [
            'msg' => 'حدث خطأ أثناء التحقق من الحساب.'. $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}


public function login(array $data)
{
    try {
        $email = $data['email'];
        $password = $data['password'];

        $user = User::where('email', $email)->first();

        if (!Hash::check($password, $user->password)) {
            return [
                'msg' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
                'success' => false,
                'data' => []
            ];
        }

        if (!$user->email_verified_at) {
            return [
                'msg' => 'رجاءً قم بتأكيد حسابك أولاً',
                'success' => false,
                'data' => []
            ];
        }

        return [
            'msg' => 'تم تسجيل الدخول بنجاح ',
            'success' => true,
            'data' =>$user
        ];

    } catch (\Exception $e) {
        return [
            'msg' => 'تسجيل الدخول فشل  ' . $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}

}

