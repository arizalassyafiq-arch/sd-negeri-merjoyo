<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student; // Pastikan Model Student di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // ... method showLogin, showRegister, dll tetap sama ...

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    // =====================
    // REGISTER (MODIFIED)
    // =====================
    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|min:6',
            // Field Tambahan untuk Klaim Anak
            'child_nis'        => 'required|string|exists:students,nisn|numeric|digits:10', // Cek NISN ada di tabel students
            'child_birth_date' => 'required|date',
        ], [
            'child_nis.exists' => 'NIS/NISN siswa tidak ditemukan di sistem sekolah.',
        ]);

        // 2. Cek Logika Kecocokan Data Siswa (Security Check)
        $student = Student::where('nisn', $request->child_nis)
            ->whereDate('birth_date', $request->child_birth_date)
            ->first();

        // Jika kombinasi NIS dan Tanggal Lahir tidak cocok
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
            'status'   => 'pending',
        ]);

        // 5. PENTING: Hubungkan User baru ke Siswa
        $student->update([
            'guardian_id' => $user->id
        ]);

        return redirect('/login')
            ->with('success', 'Registrasi Berhasil! Mohon tunggu verifikasi Admin.');
    }

    // ... sisa method login, dashboard, logout tetap sama ...
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
                    'email' => 'Akun belum aktif.',
                ]);
            }

            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

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
