<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TeacherNote;
use App\Models\LearningGoal;
use Illuminate\Http\Request;
use App\Models\LearningOutcome;
use App\Models\NoteReply; // Tambahkan ini untuk fitur balas chat
use App\Models\StudentAttendanceSummary;
use Illuminate\Support\Facades\Auth;

class GuardianAcademicController extends Controller
{
    /**
     * Menampilkan halaman form pencarian NIK
     */
    public function index()
    {
        return view('pages.search.index');
    }

    /**
     * Memproses NIK dan mengecek kecocokan dengan Wali yang login
     */
    public function check(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|digits:16',
        ]);

        // Cari siswa berdasarkan NIK dan pastikan guardian_id-nya adalah user yang sedang login
        $student = Student::where('nik', $request->nik)
            ->where('guardian_id', Auth::id())
            ->first();

        if (!$student) {
            return back()->withErrors(['nik' => 'Data tidak ditemukan atau NIK tidak terdaftar pada akun Anda.']);
        }

        // Jika cocok, redirect ke halaman show
        return redirect()->route('wali.academic.show', $student);
    }

    /**
     * Menampilkan Detail Akademik (Versi Read-Only / Wali)
     */
    public function show(Student $student)
    {
        // Security Check: Pastikan user yang akses url ini benar-benar walinya
        if ($student->guardian_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        // --- 1. DATA ABSENSI ---
        $attendanceRecord = StudentAttendanceSummary::where('student_id', $student->id)->first();

        $attendance = [
            'present' => $attendanceRecord->present ?? 0,
            'sick'    => $attendanceRecord->sick ?? 0,
            'permit'  => $attendanceRecord->permit ?? 0,
            'absent'  => $attendanceRecord->absent ?? 0,
        ];

        $totalAttendance = array_sum($attendance);
        $attendance['rate'] = $totalAttendance > 0
            ? round(($attendance['present'] / $totalAttendance) * 100)
            : 0;

        // --- 2. DATA TUJUAN PEMBELAJARAN ---

        // PERBAIKAN DISINI: Ambil nama kelas dari relasi classroom
        // Karena di tabel students kolomnya 'classroom_id', kita akses via relationship
        $className = $student->classroom->name ?? '';

        // Ambil Learning Goal berdasarkan string nama kelas (karena tabel learning_goals masih pakai string)
        $goals = LearningGoal::where('class_name', $className)->get();

        $goalCards = $goals->map(function ($goal) use ($student) {
            $outcomes = LearningOutcome::where('student_id', $student->id)
                ->where('learning_goal_id', $goal->id)
                ->get();

            // Logika hitung progress
            $avgScore = $outcomes->avg('score');
            $progress = is_numeric($avgScore) ? $avgScore : 0;

            // Tentukan status
            $status = 'STARTED';
            if ($progress >= 100) $status = 'COMPLETED';
            elseif ($progress >= 80) $status = 'ON TRACK';
            elseif ($progress >= 50) $status = 'IN REVIEW';

            return [
                'title'       => $goal->title,
                'description' => $goal->description,
                'status'      => $status,
                'progress'    => $progress
            ];
        });

        // --- 3. DATA CAPAIAN (OUTCOMES) ---
        $outcomes = LearningOutcome::with('goal')
            ->where('student_id', $student->id)
            ->latest() // pastikan model punya timestamps atau hapus latest() jika error
            ->get();

        // --- 4. DATA CATATAN GURU & CHAT ---
        // Load replies.user agar fitur chat jalan
        $notes = TeacherNote::with(['teacher', 'replies.user'])
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('pages.search.show', compact('student', 'attendance', 'goalCards', 'outcomes', 'notes'));
    }

    /**
     * Fitur Balas Pesan untuk Wali
     */
    public function storeReply(Request $request, $noteId)
    {
        $request->validate([
            'reply_content' => 'required|string|max:1000',
        ]);

        $note = TeacherNote::findOrFail($noteId);

        // Security check (opsional tapi disarankan):
        // Pastikan student dari note ini benar-benar anak dari wali yang login
        $student = Student::find($note->student_id);
        if ($student->guardian_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak membalas catatan ini.');
        }

        NoteReply::create([
            'teacher_note_id' => $note->id,
            'user_id' => Auth::id(), // ID Wali yang sedang login
            'reply_content' => $request->reply_content,
        ]);

        return back()->with('success', 'Balasan terkirim!');
    }
}
