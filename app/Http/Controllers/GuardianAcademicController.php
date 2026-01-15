<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\LearningGoal;
use App\Models\TeacherNote;
use App\Models\LearningOutcome; // Pastikan ini di-import
use App\Models\StudentAttendanceSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianAcademicController extends Controller
{
    /**
     * Menampilkan halaman form pencarian NIK
     */
    public function index()
    {
        // Sesuaikan path view jika folder Anda berbeda
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
     * Menampilkan Detail Akademik (Versi Read-Only)
     */
    public function show(Student $student)
    {
        // Security Check: Pastikan user yang akses url ini benar-benar walinya
        if ($student->guardian_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        // --- PERBAIKAN DI SINI ---
        // Kita menghapus where('semester') dan where('academic_year')
        // karena kolom tersebut tidak ada di Model StudentAttendanceSummary Anda.

        $attendanceRecord = StudentAttendanceSummary::where('student_id', $student->id)->first();

        $attendance = [
            'present' => $attendanceRecord->present ?? 0,
            'sick'    => $attendanceRecord->sick ?? 0,
            'permit'  => $attendanceRecord->permit ?? 0,
            'absent'  => $attendanceRecord->absent ?? 0,
        ];

        $totalAttendance = array_sum($attendance);

        // Menghindari division by zero
        $attendance['rate'] = $totalAttendance > 0
            ? round(($attendance['present'] / $totalAttendance) * 100)
            : 0;

        // 2. Data Learning Goals (Tujuan Pembelajaran)
        // Mengambil goal berdasarkan kelas siswa
        $goals = LearningGoal::where('class_name', $student->class_name)->get();

        $goalCards = $goals->map(function ($goal) use ($student) {
            // Logika hitung progres per goal berdasarkan outcome siswa
            $outcomes = LearningOutcome::where('student_id', $student->id)
                ->where('learning_goal_id', $goal->id)
                ->get();

            // Rata-rata skor
            $avgScore = $outcomes->avg('score');
            $progress = is_numeric($avgScore) ? $avgScore : 0;

            // Tentukan status visual
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

        // 3. Data Outcomes (Capaian Detail / Riwayat Nilai)
        $outcomes = LearningOutcome::with('goal')
            ->where('student_id', $student->id)
            // Menggunakan latest() membutuhkan kolom created_at. 
            // Jika error, hapus ->latest() atau pastikan tabel memiliki timestamps.
            ->latest('id')
            ->get();

        // 4. Data Notes (Catatan Guru)
        $notes = TeacherNote::with('teacher')
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('pages.search.show', compact('student', 'attendance', 'goalCards', 'outcomes', 'notes'));
    }
}
