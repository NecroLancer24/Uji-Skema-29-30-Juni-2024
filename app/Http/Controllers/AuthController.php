<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = [
            "email" => $request->email,
            "password" => $request->password
        ];
        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            return redirect(route('home'))->with('success', "Berhasil Login");
        } else {
            return back()->with('error', 'Email atau Password Salah');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect(route('login'));
    }

    public function registerView()
    {
        if (Auth::user()->role_id == 1) {
            $role = role::get();
            return view('users.register', compact('role'));
        } else {
            return back()->with('warning', 'Anda tidak memiliki akses');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required'
        ],[
            'nama.required'=> 'Nama Wajib Di isi',
            'email.required'=>'Email Wajib Di isi',
            'email.email'=> 'Email Tidak Valid',
            'email.unique'=> 'Email Sudah Dipakai',
            'password.required'=>'Password harus Di isi',
            'password.min'=>'Password Minimal 8 Karakter',
            'role.required'=>'Pilih role yang benar'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role
        ]);

        return redirect(route('home'))->with('success', 'Menambah User');
    }

    public function loginView()
    {
        return view('users.login');
    }
}
