<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\TeacherNote;
use App\Models\LearningGoal;
use Illuminate\Http\Request;
use App\Models\LearningOutcome;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentAttendanceSummary;
use App\Models\NoteReply;

class AcademicManagementController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $isGuru = $user && $user->role === 'guru';

        // 1. Query Data (Sama seperti sebelumnya)
        $query = Student::with('guardian', 'classroom');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class')) {
            $query->where('classroom_id', $request->class);
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        // --- LOGIKA BARU UNTUK AJAX ---
        // Jika request ini adalah AJAX (dari fetch javascript), kembalikan potongan HTML saja
        if ($request->ajax()) {
            return view('admin.academic.partials.table_rows', compact('students'))->render();
        }
        // ------------------------------

        $totalStudents = Student::count();
        $classrooms = Classroom::orderBy('name')->get();

        return view('admin.academic.index', [
            'isGuru' => $isGuru,
            'totalStudents' => $totalStudents,
            'students' => $students,
            'classrooms' => $classrooms,
        ]);
    }

    public function show(Student $student)
    {
        $user = Auth::user();
        $isGuru = $user && $user->role === 'guru';

        // Ambil nama kelas dari relasi classroom
        // Jika siswa belum masuk kelas, beri nilai default string kosong
        $className = $student->classroom->name ?? '';

        // PERBAIKAN 2: Menggunakan variable $className dari relasi
        $goals = LearningGoal::where('class_name', $className)
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $availableGoals = LearningGoal::where('class_name', $className)
            ->orderBy('title')
            ->get();

        $outcomes = LearningOutcome::with('goal')
            ->where('student_id', $student->id)
            ->orderByDesc('created_at')
            ->get();

        $notes = TeacherNote::with(['teacher', 'replies.user'])
            ->where('student_id', $student->id)
            ->orderByDesc('created_at')
            ->get();

        $goalCards = $goals->map(function ($goal) use ($outcomes) {
            $outcome = $outcomes->firstWhere('learning_goal_id', $goal->id);
            $progress = $outcome ? $this->scoreToProgress($outcome->score) : 0;
            $status = $this->statusFromProgress($progress);

            return [
                'title' => $goal->title,
                'description' => $goal->description,
                'progress' => $progress,
                'status' => $status,
            ];
        });

        $attendanceSummary = StudentAttendanceSummary::where('student_id', $student->id)->first();
        $present = $attendanceSummary?->present ?? 0;
        $sick = $attendanceSummary?->sick ?? 0;
        $permit = $attendanceSummary?->permit ?? 0;
        $absent = $attendanceSummary?->absent ?? 0;
        $total = $present + $sick + $permit + $absent;
        $rate = $total > 0 ? (int) round(($present / $total) * 100) : 0;
        $attendance = [
            'rate' => $rate,
            'present' => $present,
            'sick' => $sick,
            'permit' => $permit,
            'absent' => $absent,
        ];

        return view('admin.academic.show', [
            'isGuru' => $isGuru,
            'student' => $student,
            'goalCards' => $goalCards,
            'availableGoals' => $availableGoals,
            'outcomes' => $outcomes,
            'notes' => $notes,
            'attendance' => $attendance,
        ]);
    }

    // --- Helper Methods ---
    private function scoreToProgress(?string $score): int
    {
        if ($score === null) return 0;
        $raw = trim($score);
        if (is_numeric($raw)) return max(0, min(100, (int) round((float) $raw)));
        if (preg_match('/\d+/', $raw, $matches)) return max(0, min(100, (int) $matches[0]));
        return 0;
    }

    private function statusFromProgress(int $progress): string
    {
        if ($progress >= 100) return 'COMPLETED';
        if ($progress >= 70) return 'ON TRACK';
        if ($progress >= 40) return 'IN REVIEW';
        return 'STARTED';
    }

    // --- Store Methods ---

    public function storeAttendance(Request $request, Student $student)
    {
        $data = $request->validate([
            'present' => 'required|integer|min:0',
            'sick' => 'required|integer|min:0',
            'permit' => 'required|integer|min:0',
            'absent' => 'required|integer|min:0',
        ]);

        StudentAttendanceSummary::updateOrCreate(
            ['student_id' => $student->id],
            [
                'present' => $data['present'],
                'sick' => $data['sick'],
                'permit' => $data['permit'],
                'absent' => $data['absent'],
                'updated_by' => Auth::id(),
            ]
        );

        return back()->with('status', 'Absensi siswa berhasil diperbarui.');
    }

    public function storeGoal(Request $request, Student $student)
    {
        // Pastikan siswa sudah masuk kelas sebelum buat goal
        if (!$student->classroom) {
            return back()->withErrors(['msg' => 'Siswa ini belum dimasukkan ke dalam kelas. Silakan edit data siswa terlebih dahulu.']);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        LearningGoal::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            // PERBAIKAN 3: Ambil nama kelas dari relasi classroom, bukan column class_name
            'class_name' => $student->classroom->name,
            'created_by' => Auth::id(),
        ]);

        return back()->with('status', 'Tujuan pembelajaran berhasil ditambahkan.');
    }

    public function storeOutcome(Request $request, Student $student)
    {
        // Pastikan siswa punya kelas
        if (!$student->classroom) {
            return back()->withErrors(['msg' => 'Siswa belum memiliki kelas.']);
        }

        $data = $request->validate([
            'learning_goal_id' => 'required|exists:learning_goals,id',
            'score' => 'required|string|max:50',
            'note' => 'nullable|string',
        ]);

        // PERBAIKAN 4: Validasi goal harus sesuai dengan nama kelas dari relasi
        $goal = LearningGoal::where('id', $data['learning_goal_id'])
            ->where('class_name', $student->classroom->name)
            ->firstOrFail();

        LearningOutcome::create([
            'student_id' => $student->id,
            'learning_goal_id' => $goal->id,
            'score' => $data['score'],
            'note' => $data['note'] ?? null,
            'created_by' => Auth::id(),
        ]);

        return back()->with('status', 'Capaian siswa berhasil ditambahkan.');
    }

    public function storeNote(Request $request, Student $student)
    {
        $data = $request->validate([
            'note' => 'required|string',
        ]);

        TeacherNote::create([
            'student_id' => $student->id,
            'teacher_id' => Auth::id(),
            'note' => $data['note'],
        ]);

        return back()->with('status', 'Catatan guru berhasil ditambahkan.');
    }

    public function storeReply(Request $request, $noteId)
    {
        $request->validate([
            'reply_content' => 'required|string|max:1000',
        ]);

        $note = TeacherNote::findOrFail($noteId);

        NoteReply::create([
            'teacher_note_id' => $note->id,
            'user_id' => Auth::id(),
            'reply_content' => $request->reply_content,
        ]);

        return back()->with('status', 'Balasan berhasil dikirim.');
    }
}
