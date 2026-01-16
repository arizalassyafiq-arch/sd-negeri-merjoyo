<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Mail\NewTeacherWelcome;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    // MENAMPILKAN DAFTAR GURU
    // MENAMPILKAN DAFTAR GURU
    public function index(Request $request)
    {
        $query = Teacher::with('user');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {

                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })

                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // 4. Pagination dengan 'withQueryString' agar parameter search tidak hilang saat pindah halaman
        $teachers = $query->latest()->paginate(10)->withQueryString();

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'subject' => 'required|string',
        ]);

        $defaultPassword = 'guru123';

        DB::transaction(function () use ($request, $defaultPassword) {

            // A. Buat User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($defaultPassword),
                'role' => 'guru',
                'status' => 'active',
                'email_verified_at' => now(),
            ]);

            // B. Buat Profil Teacher
            Teacher::create([
                'user_id' => $user->id,
                'subject' => $request->subject,
            ]);
            try {
                Mail::to($user->email)->send(new NewTeacherWelcome($user, $defaultPassword));
            } catch (\Exception $e) {
                Log::error('Gagal kirim email welcome ke guru: ' . $e->getMessage());
            }
        });

        return redirect()->route('admin.teachers.index')
            ->with('status', 'Guru berhasil ditambahkan & Email notifikasi telah dikirim.');
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
