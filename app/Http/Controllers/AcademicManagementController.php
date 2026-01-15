<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\TeacherNote;
use App\Models\LearningGoal;
use Illuminate\Http\Request;
use App\Models\NoteReply; // <--- PENTING: Jangan lupa import ini
use App\Models\LearningOutcome;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentAttendanceSummary;

class AcademicManagementController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $isGuru = $user && $user->role === 'guru';

        // Eager load classroom untuk efisiensi
        $query = Student::with('guardian', 'classroom');

        if ($request->has('class') && $request->class !== '') {
            $query->where('classroom_id', $request->class);
        }

        $students = $query->latest()->paginate(10);
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

        $goals = LearningGoal::where('class_name', $student->class_name)
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $availableGoals = LearningGoal::where('class_name', $student->class_name)
            ->orderBy('title')
            ->get();

        $outcomes = LearningOutcome::with('goal')
            ->where('student_id', $student->id)
            ->orderByDesc('created_at')
            ->get();

        // PENTING: Load 'replies.user' untuk fitur chat/diskusi
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
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        LearningGoal::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'class_name' => $student->class_name,
            'created_by' => Auth::id(),
        ]);

        return back()->with('status', 'Tujuan pembelajaran berhasil ditambahkan.');
    }

    public function storeOutcome(Request $request, Student $student)
    {
        $data = $request->validate([
            'learning_goal_id' => 'required|exists:learning_goals,id',
            'score' => 'required|string|max:50',
            'note' => 'nullable|string',
        ]);

        $goal = LearningGoal::where('id', $data['learning_goal_id'])
            ->where('class_name', $student->class_name) // Pastikan goal sesuai kelas
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
