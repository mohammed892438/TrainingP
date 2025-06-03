<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function showRegistrationForm(){
        return view('user.trainer.complete-register-form');
    }
}
