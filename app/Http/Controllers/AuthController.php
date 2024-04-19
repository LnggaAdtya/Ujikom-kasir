<?php

namespace App\Http\Controllers;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginKasir()
    {
        return view('kasir.dashboard');
    }

    public function auth (Request $request)
    {
        $request->validate([
            'email'=> 'required|email:dns',
            'password' => 'required',
        ]);

        $user = $request->only('email','password');
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('landing');
            } elseif (Auth::user()->role == 'employe') {
                return redirect()->route('employe.employeLanding');
            }
            
        } else {
            return redirect()->back()->with('Failed', 'login failed try again');
        }
        
    }
}
