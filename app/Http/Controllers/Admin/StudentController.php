<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    // MENAMPILKAN DATA (READ)
    public function index(Request $request)
    {
        $query = Student::with('guardian');

        if ($request->has('class') && $request->class != '') {
            $query->where('class_name', $request->class);
        }

        $students = $query->latest()->paginate(10);
        $totalStudents = Student::count();

        // Kita kirim filter kelas ke view untuk tombol navigasi
        $classOptions = ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6'];

        return view('admin.data_siswa.index', compact('students', 'totalStudents', 'classOptions'));
    }

    // FORM TAMBAH (CREATE)
    public function create()
    {
        // Ambil data wali untuk dropdown (opsional, jika ingin menghubungkan manual)
        $guardians = User::where('role', 'wali')->where('status', 'active')->get();

        return view('admin.data_siswa.create', compact('guardians'));
    }

    // PROSES SIMPAN (STORE)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:students,nik',
            'nisn' => 'required|string|unique:students,nisn', // NISN Wajib untuk login Ortu
            'gender' => 'required|in:L,P',
            'class_name' => 'required|string',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'guardian_id' => 'nullable',
            'status' => 'required|in:active,lulus,drop_out,pindah',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
        ]);

        Student::create($validated);

        return redirect()->route('admin.students.index')
            ->with('status', 'Siswa berhasil ditambahkan.');
    }

    // FORM EDIT (EDIT)
    public function edit(Student $student)
    {
        $guardians = User::where('role', 'wali')->where('status', 'active')->get();
        return view('admin.data_siswa.edit', compact('student', 'guardians'));
    }

    // PROSES UPDATE (UPDATE)
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => ['required', 'numeric', 'digits:16', Rule::unique('students')->ignore($student->id)],
            'nisn' => ['required', 'string', Rule::unique('students')->ignore($student->id)],
            'gender' => 'required|in:L,P',
            'class_name' => 'required|string',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'guardian_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,lulus,drop_out,pindah',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')
            ->with('status', 'Data siswa berhasil diperbarui.');
    }

    // HAPUS (DELETE)
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')
            ->with('status', 'Data siswa berhasil dihapus.');
    }
}
