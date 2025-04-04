<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function processRegistrasi()
    {
        return view('registrasi');
    }

    public function submitRegistrasi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:10',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('login.process');
    }

    public function processLogin()
    {
        return view('login');
    }

    public function submitLogin(Request $request)
    {
        $request->validate([
            'email'=> 'required|email',
            'password' => 'required',
        ]);
        
        $data = $request->only('email', 'password');

        if (Auth::attempt($data))
        {
           $request->session()->regenerate();
           return redirect()->route('siswa.tampil');
        } else{
            return redirect()->back()->withErrors([
                'login' => 'Email atau password anda salah.',])->withInput();
        }
    }
}