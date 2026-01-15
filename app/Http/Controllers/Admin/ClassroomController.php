<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassroomController extends Controller
{
    /**
     * Tampilkan daftar kelas
     */
    public function index()
    {
        // Ambil data kelas + wali kelas + hitung jumlah siswa
        $classrooms = Classroom::with('teacher.user')
            ->withCount('students') // Menghitung jumlah siswa per kelas otomatis
            ->orderBy('name')
            ->paginate(10);

        return view('admin.classrooms.index', compact('classrooms'));
    }

    /**
     * Form tambah kelas
     */
    public function create()
    {
        $teachers = Teacher::with('user')->get();
        return view('admin.classrooms.create', compact('teachers'));
    }

    /**
     * Simpan kelas baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:classrooms,name|max:50',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        Classroom::create($request->all());

        return redirect()->route('admin.classrooms.index')
            ->with('status', 'Kelas berhasil dibuat.');
    }

    /**
     * Form edit kelas
     */
    public function edit(Classroom $classroom)
    {
        $teachers = Teacher::with('user')->get();
        return view('admin.classrooms.edit', compact('classroom', 'teachers'));
    }

    /**
     * Update data kelas
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            // Validasi nama unik tapi abaikan ID kelas yang sedang diedit
            'name' => ['required', 'string', 'max:50', Rule::unique('classrooms')->ignore($classroom->id)],
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $classroom->update($request->all());

        return redirect()->route('admin.classrooms.index')
            ->with('status', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Hapus kelas
     */
    public function destroy(Classroom $classroom)
    {
        // Cek jika kelas masih punya siswa (optional, bisa juga pakai try-catch constraint)
        if ($classroom->students()->count() > 0) {
            return back()->withErrors(['error' => 'Gagal menghapus! Masih ada siswa di dalam kelas ini.']);
        }

        $classroom->delete();

        return redirect()->route('admin.classrooms.index')
            ->with('status', 'Kelas berhasil dihapus.');
    }
}
