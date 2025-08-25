<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisteredController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'username'=>'required|max:255|min:2|unique:users|string|alpha_dash:ascii',
            'email'=>'required|email|unique:users|string|max:255',
            'password'=>['required','confirmed',Password::min(8)->letters()->numbers()->symbols()],
            //'confirm_password'=>'required|same:password'
        ]);
        User::create($validated);
        return toastResponse('success', 'User created successfully.', '/login', 201);
    }
}
