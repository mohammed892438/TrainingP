<?php

namespace App\Services;

use App\Mail\CompleteProfileMail;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

        switch ($userType->id) {
            case 1:
                $link = route('complete-trainer-register', ['id' => $id]);
                break;
            case 3:
                $link = route('complete-trainee-register', ['id' => $id]);
                break;
            case 2:
                $link = route('complete-assistant-register', ['id' => $id]);
                break;
            case 4:
                $link = route('complete-organization-register', ['id' => $id]);
                break;
        }

        return [
            'msg' => 'تم التحقق من الحساب بنجاح .',
            'success' => true,
            'data' => [
                'user' => $user,
                'link' => $link
            ],
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
        $remember = isset($data['remember']) ? $data['remember'] : false;

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return [
                'msg' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
                'success' => false,
                'data' => []
            ];
        }

        if (!$user->email_verified_at) {
            return [
                'msg' => 'رجاءً قم بتأكيد حسابك أولاً، تم إرسال رابط التحقق إلى بريدك الإلكتروني.',
                'success' => false,
                'data' => []
            ];
        }

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->accessToken;
            if ($remember) {
                $expiresAt = now()->addDays(7);
            } else {
                $expiresAt = now()->addHours(2); 
            }

            return [
                'msg' => 'تم تسجيل الدخول بنجاح',
                'success' => true,
                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'expires_at' => $expiresAt
                ]
            ];
        } else {
            return [
                'msg' => 'فشل تسجيل الدخول، حاول مرة أخرى.',
                'success' => false,
                'data' => []
            ];
        }
    } catch (\Exception $e) {
        return [
            'msg' => 'تسجيل الدخول فشل: ' . $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}


public function logout()
    {
        try {
            $user = Auth::user();
            $user->tokens()->delete();
            return [
                'msg' => 'تم التسجيل الخروج بنجاح.',
                'success' => false,
                'data' => []
            ];
        } catch (\Exception $e) {
            return [
                'msg' => 'تسجيل الدخول فشل: ' . $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function resendVerificationEmail($id)
{
    try {
        $user = User::findOrFail($id);
        $link = route('verify-user', ['id' => $user->id]);

        if ($link) {
            Mail::to($user->email)->send(new CompleteProfileMail($link));
        }

        return [
            'msg' => 'تم إرسال رابط التحقق مرة أخرى إلى بريدك الإلكتروني.',
            'success' => true,
            'data' => []
        ];
    } catch (\Exception $e) {
        return [
            'msg' => 'حدث خطأ أثناء إعادة إرسال البريد الإلكتروني: ' . $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}
}

