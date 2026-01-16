<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Student;
use App\Models\Classroom; // Import Model Classroom
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    // MENAMPILKAN DATA (READ)
    public function index(Request $request)
    {
        // Eager load guardian AND classroom to avoid N+1 problem
        $query = Student::with(['guardian', 'classroom']);

        // Filter based on classroom_id
        if ($request->has('class') && $request->class != '') {
            $query->where('classroom_id', $request->class);
        }

        $students = $query->latest()->paginate(10);
        $totalStudents = Student::count();

        // Fetch classrooms from DB for the filter buttons
        $classrooms = Classroom::orderBy('name')->get();

        return view('admin.data_siswa.index', compact('students', 'totalStudents', 'classrooms'));
    }

    // FORM TAMBAH (CREATE)
    public function create()
    {
        $classrooms = Classroom::all();
        $guardians = User::where('role', 'wali')->where('status', 'active')->get();

        return view('admin.data_siswa.create', compact('guardians', 'classrooms'));
    }

    // PROSES SIMPAN (STORE)
    public function store(Request $request)
    {
        // Parameter 1: Rules Validasi
        $rules = [
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:students,nik',
            'nisn' => 'required|string|unique:students,nisn',
            'gender' => 'required|in:L,P',
            'classroom_id' => 'required|exists:classrooms,id',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'guardian_id' => 'nullable',
            'status' => 'required|in:active,lulus,drop_out,pindah',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
        ];

        // Parameter 2: Custom Messages (Pesan Error Bahasa Indonesia)
        $messages = [
            'nik.unique' => 'NIK ini sudah terdaftar di sistem. Mohon cek kembali.',
            'nik.digits' => 'NIK harus berjumlah 16 digit.',
            'nisn.unique' => 'NISN ini sudah digunakan oleh siswa lain.',
            'name.required' => 'Nama siswa wajib diisi.',
            'classroom_id.required' => 'Silakan pilih kelas terlebih dahulu.',
        ];

        $validated = $request->validate($rules, $messages);

        Student::create($validated);

        return redirect()->route('admin.students.index')
            ->with('status', 'Siswa berhasil ditambahkan.');
    }

    // FORM EDIT (EDIT)
    public function edit(Student $student)
    {
        $classrooms = Classroom::all(); // Pass classrooms to edit view
        $guardians = User::where('role', 'wali')->where('status', 'active')->get();
        return view('admin.data_siswa.edit', compact('student', 'guardians', 'classrooms'));
    }

    // PROSES UPDATE (UPDATE)
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => ['required', 'numeric', 'digits:16', Rule::unique('students')->ignore($student->id)],
            'nisn' => ['required', 'string', Rule::unique('students')->ignore($student->id)],
            'gender' => 'required|in:L,P',
            'classroom_id' => 'required|exists:classrooms,id', // Update validation
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
