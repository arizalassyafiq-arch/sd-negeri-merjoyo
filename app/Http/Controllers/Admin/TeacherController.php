<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    // MENAMPILKAN DAFTAR GURU
    public function index()
    {
        // Ambil data guru beserta data user-nya
        $teachers = Teacher::with('user')->latest()->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    // FORM TAMBAH GURU
    public function create()
    {
        return view('admin.teachers.create');
    }

    // PROSES SIMPAN GURU (LOGIC UTAMA)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Cek unik di tabel users
            // 'nip' => 'required|string|unique:teachers,nip', // Cek unik di tabel teachers
            'subject' => 'required|string',
            // 'phone' => 'nullable|string',
        ]);

        // 2. Gunakan DB Transaction (Agar data masuk ke 2 tabel sekaligus dengan aman)
        DB::transaction(function () use ($request) {

            // A. Buat Akun Login di tabel 'users' (Sesuai migrasi Anda)
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                // Kita buatkan password default, nanti guru bisa ganti sendiri
                'password' => Hash::make('guru123'),
                'role' => 'guru',        // Sesuai enum Anda
                'status' => 'active',    // Langsung aktif karena Admin yang input
                'email_verified_at' => now(), // Opsional: anggap email sudah verifikasi
            ]);

            // B. Buat Profil Detail di tabel 'teachers'
            Teacher::create([
                'user_id' => $user->id, // Ambil ID dari user yang baru dibuat
                // 'nip' => $request->nip,
                'subject' => $request->subject,
                // 'phone' => $request->phone,
            ]);
        });

        return redirect()->route('admin.teachers.index')
            ->with('status', 'Guru berhasil ditambahkan. Password default: guru123');
    }

    // FORM EDIT
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    // PROSES UPDATE
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($teacher->user_id)],
            // 'nip' => ['required', Rule::unique('teachers')->ignore($teacher->id)],
            'subject' => 'required',
        ]);

        DB::transaction(function () use ($request, $teacher) {
            // Update tabel Users
            $teacher->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Update tabel Teachers
            $teacher->update([
                // 'nip' => $request->nip,
                'subject' => $request->subject,
                // 'phone' => $request->phone,
            ]);
        });

        return redirect()->route('admin.teachers.index')->with('status', 'Data guru diperbarui.');
    }

    // PROSES HAPUS
    public function destroy(Teacher $teacher)
    {
        // Hapus usernya saja, data teacher otomatis hilang karena 'onDelete cascade'
        $teacher->user->delete();
        return back()->with('status', 'Data guru berhasil dihapus.');
    }
}
