<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    // =====================
    // REGISTER (SECURE MODE)
    // =====================
    public function register(Request $request)
    {
        // 1. Validasi Input (Super Ketat)
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',

            'password'         => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],

            'child_nis'        => 'required|string|exists:students,nisn|numeric|digits:10',
            'child_birth_date' => 'required|date',
        ], [
            'child_nis.exists'  => 'NIS/NISN siswa tidak ditemukan di sistem sekolah.',
            'password.regex'    => 'Password harus mengandung huruf besar, huruf kecil, dan angka.',
            'password.min'      => 'Password minimal 8 karakter.',
        ]);

        // 2. Cek Logika Kecocokan Data Siswa
        $student = Student::where('nisn', $request->child_nis)
            ->whereDate('birth_date', $request->child_birth_date)
            ->first();

        if (!$student) {
            throw ValidationException::withMessages([
                'child_birth_date' => 'Tanggal lahir tidak cocok dengan data NIS tersebut.',
            ]);
        }

        // 3. Cek apakah siswa sudah punya wali?
        if ($student->guardian_id) {
            throw ValidationException::withMessages([
                'child_nis' => 'Siswa ini sudah memiliki akun wali yang terdaftar. Hubungi sekolah.',
            ]);
        }

        // 4. Buat Akun Wali (Status Pending)
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'wali',
            'status'   => 'pending', // Wajib Pending agar dicek Admin
        ]);

        // 5. Hubungkan ke Siswa
        $student->update([
            'guardian_id' => $user->id
        ]);

        // PESAN: Sesuai permintaan
        return redirect('/login')
            ->with('success', 'Registrasi Berhasil! Mohon tunggu verifikasi Admin.');
    }

    // =====================
    // LOGIN (ANTI BRUTE FORCE)
    // =====================
    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // 2. Key Rate Limiter (Email + IP)
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()->withErrors([
                'email' => 'Terlalu banyak percobaan login gagal. Silakan coba lagi dalam ' . $seconds . ' detik.',
            ])->onlyInput('email');
        }

        $remember = $request->boolean('remember');

        // 4. Proses Login
        if (Auth::attempt($credentials, $remember)) {

            $user = Auth::user();

            // Cek status user (Harus Active)
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun belum aktif atau sedang menunggu verifikasi admin.']);
            }

            // BERHASIL: Hapus limit
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        RateLimiter::hit($throttleKey, 120);

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function dashboard()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect('/admin/dashboard');
        }
        if ($role === 'guru') {
            return redirect('/guru/dashboard');
        }

        return view('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
