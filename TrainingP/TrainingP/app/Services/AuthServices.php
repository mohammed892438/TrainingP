<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class AuthServices
{
    public function login($email, $password)
    {
        try {
            $user = User::where('email', $email)->first();
            if ($user && Hash::check($password, $user->password)) {
                $token = $user->createToken('Personal Access Token')->accessToken;
                return [
                    'msg' => "Login successfully",
                    'success' => true,
                    'data' => [
                        'user' => $user,
                        'token' => $token
                    ]
                ];
            }
    
            return [
                'msg' => 'Invalid credentials.',
                'success' => false,
                'data' => []
            ];
        } catch (\Exception $e) {
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

public function register($data)
    {
        try{
            $data['password'] = Hash::make($data['password']); 
            $user = User::create($data);
            $user->save();

            //Mail::to($user->email)->send(new ShortCodeMail($otp, $user->user_name));

            return [
                'msg' => 'Account created successfully',
                'success' => true,
                'data' => $user
            ];
        }catch (\Exception $e) {
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }
}
