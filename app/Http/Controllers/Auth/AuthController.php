<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =====================
    // SHOW LOGIN
    // =====================
    public function showLogin()
    {
        return view('auth.login');
    }

    // =====================
    // SHOW REGISTER (WALI)
    // =====================
    public function showRegister()
    {
        return view('auth.register');
    }

    // =====================
    // REGISTER (ONLY WALI)
    // =====================
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'wali',
            'status'   => 'pending', // WAJIB pending
        ]);

        return redirect('/login')
            ->with('success', 'Akun berhasil dibuat. Menunggu persetujuan sekolah.');
    }

    // =====================
    // LOGIN (ALL ROLE)
    // =====================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // Cek status user
            if ($user->status !== 'active') {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun belum aktif atau ditolak oleh sekolah.',
                ]);
            }

            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // =====================
    // DASHBOARD REDIRECT
    // =====================
    public function dashboard()
    {
        // $role = auth()->user()->role;
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($role === 'guru') {
            return redirect('/guru/dashboard');
        }

        return redirect('/wali/dashboard');
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
