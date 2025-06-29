<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index(){
        return view('dashboard.management.register');
    }
    public function store_register(Request $request){
        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string'],
                'role' => 'required|in:manager,blogger,user',
        ]);
        User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>encrypt($request->password),
            'role' => $request->role,
            'created_at' => now(),
        ]);
            return back()->with('success', 'Registration successfull..!');
    }
}
