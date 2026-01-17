<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class PasswordResetController extends Controller
{
    // 1. Tampilkan Form Lupa Password
    public function create()
    {
        return view('auth.forgot-password');
    }

    // 2. Kirim Link Reset ke Email
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Kirim link reset password
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('success', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    // 3. Tampilkan Form Reset Password (Password Baru)
    public function edit(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    // 4. Proses Simpan Password Baru
    public function update(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Proses reset password menggunakan broker Laravel
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}
