<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            'nisn' => 'required|string|max:10|unique:users,nisn',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Buat user baru
        $user = new User();
        $user->name = $request->name;
        $user->nisn = $request->nisn;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // 🔑 Assign role 'siswa' setelah user berhasil dibuat
        $user->assignRole('siswa');

        // Kirim email verifikasi
        event(new Registered($user));

        //user otomatis ke halaman login
        Auth::login($user);

        // Redirect ke halaman notifikasi verifikasi
        return redirect()->route('verification.notice')->with('status', 'verification-link-sent');
    }

    public function processLogin()
    {
        return view('login');
    }

    public function submitLogin(Request $request)
    {
        $request->validate([
            'nisn' => 'required|digits:10',
            'email'=> 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        if ($user->nisn !== $request->nisn) {
            return back()->withErrors(['nisn' => 'NISN tidak cocok dengan akun ini.']);
        }

        // Cek apakah password cocok
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        // Cek verifikasi email
        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice')
                ->withErrors(['login' => 'Silakan verifikasi email Anda terlebih dahulu.']);
        }

        // // Cek apakah punya role siswa
        // if (!$user->hasRole('siswa')) {
        //     return back()->withErrors(['login' => 'Akun anda tidak memiliki akses sebagai siswa.']);
        // }

        // Jika semua valid, login
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('profile.index');
    }
}
