<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'username'=>'required|string',
            'password'=>'required|string'
        ]);

        if(auth()->attempt($validated)){
            if(!auth()->user()->hasVerifiedEmail()){
                return toastResponse('success', 'Logged in!', '/email/verify');
            }
            return toastResponse('success', 'Logged in!', '/');
        }

        $request->session()->regenerate();

        return toastResponse('error', 'Invalid credentials');
    }

    public function destroy(){
        Auth::logout();
        return toastResponse('warning', 'Logged out.', '/');
    }
}
