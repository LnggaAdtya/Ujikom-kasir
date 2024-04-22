<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginEmploye()
    {
        return view('employe.employeDash');
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
                return redirect()->route('employe.employeDash');
            }
            
        } else {
            return redirect()->back()->with('Failed', 'login failed try again');
        }
        
    }

    public function register()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('admin.user', compact('users')); 
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'name' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);
    
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('user')->with('success', 'Akun berhasil dibuat! Silakan login.');
    
    }

    public function editUser($id)
    {
        $dataUser = User::where('id', '=', $id)->first();
        return view('admin.editUser', compact('dataUser'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'name' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        
        User::where('id', '=', $id)->update ([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user')->with('success', 'Akun berhasil diupdate!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id); 
        $user->delete();
    
        return redirect()->route('user')->with('success', 'Pengguna berhasil dihapus!');
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
