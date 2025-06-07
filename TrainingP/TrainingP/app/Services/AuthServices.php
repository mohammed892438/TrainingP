<?php

namespace App\Services;

use App\Mail\CompleteProfileMail;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
class AuthServices
{
    public function register($data)
{
    try {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->save();

        Mail::to($user->email)->send(new CompleteProfileMail($user));

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
        if ($user->email_verified_at) {
            return [
                'success' => false,
                'msg' => 'تم التحقق من حسابك مسبقًا.',
                'data' => [],
                'code' => 'already_verified'
            ];
        }

        $user->email_verified_at = now();
        $user->save();

        $routes = [
            1 => 'complete-trainer-register',
            2 => 'complete-assistant-register',
            3 => 'complete-trainee-register',
            4 => 'complete-organization-register',
        ];
        $routeName = $routes[$user->user_type_id] ?? 'home';
        $link = URL::temporarySignedRoute(
            $routeName,
            now()->addMinutes(15),
            ['id' => $user->id] 
        );

        return [
            'success' => true,
            'msg' => 'تم التحقق من الحساب بنجاح يرجى تكملة معلومات الحساب.',
            'data' => [
                'link' => $link
            ]
        ];
    } catch (\Exception $e) {
        return [
            'success' => false,
            'msg' => 'حدث خطأ أثناء التحقق: ' . $e->getMessage(),
            'data' => [],
            'code' => 'exception'
        ];
    }
}

public function resendVerificationEmail($id)
{
    try {
        $user = User::findOrFail($id);
        
        if ($user->email_verified_at) {
            return [
                'msg' => 'تم التحقق من البريد الإلكتروني مسبقًا.',
                'success' => false,
                'data' => []
            ];
            
        }
        else{
           
            Mail::to($user->email)->send(new CompleteProfileMail($user));
        return [
            'msg' => 'تم إرسال رابط التحقق مرة أخرى إلى بريدك الإلكتروني.',
            'success' => true,
            'data' => $user
        ];
        
    }
    } catch (\Exception $e) {
        return [
            'msg' => 'حدث خطأ أثناء إعادة إرسال البريد الإلكتروني: ' . $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
    
}






public function login(array $data)
{
    try {
        $remember = isset($data['remember']) ? (bool)$data['remember'] : false;
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
            session(['user_id' => Auth::id(), 'email' => Auth::user()->email]);
            if ($remember) {
                config(['session.lifetime' => 20160]); // 14 days
            }

            return [
                'msg' => 'تم تسجيل الدخول بنجاح.',
                'success' => true,
                'data' => Auth::user()
            ];
        }

        return [
            'msg' => 'فشل في تسجيل الدخول. يرجى التحقق من البيانات المدخلة.',
            'success' => false,
            'data' => []
        ];
    } catch (\Exception $e) {
        return [
            'msg' => 'حدث خطأ غير متوقع: ' . $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}

//logout
public function logout($request)
{
    try {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return [
            'msg' => 'تم تسجيل الخروج بنجاح.',
            'success' => true
        ];
    } catch (\Exception $e) {
        return [
            'msg' => 'حدث خطأ أثناء تسجيل الخروج: ' . $e->getMessage(),
            'success' => false
        ];
    }
}

   

}