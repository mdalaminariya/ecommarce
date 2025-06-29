<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(){
        return view('frontend.auth.register');
    }
    public function register_post(Request $request){
        $request->validate([
            "*" => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
        ]);
        return redirect()->route('auth.login')->with('success', 'Registration successful, please login.');
    }
    public function login(){
        return view('frontend.auth.login');
    }
    public function login_post(){
        if(auth()->attempt(request(['email', 'password']))){
            return redirect()->route('dashboard.home')->with('success', 'Login successful.');
        }
    }
}
