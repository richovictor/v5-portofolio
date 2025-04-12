<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // Form untuk masukkan email
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Kirim link reset ke email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'Link reset password berhasil dikirim ke email kamu.'])
            : back()->withErrors(['email' => 'Gagal mengirim link reset. periksa kembali email kamu.']);
    }

    // Form reset password (via email link)
    public function showResetForm($token)
    {
        session(['reset_token' => $token]);
        return view('auth.reset-password', ['token' => $token]);
    }

    // Simpan password baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
