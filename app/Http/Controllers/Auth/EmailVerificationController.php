<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class EmailVerificationController extends Controller
{

    public function notice()
    {
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return toastResponse('success', 'Email Verified Successfully', '/');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return toastResponse('success', 'Verification link sent!');
    }
}
