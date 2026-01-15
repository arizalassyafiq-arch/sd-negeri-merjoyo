<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Student;
use App\Models\LearningGoal; // Tambahkan ini
use App\Models\StudentAttendanceSummary; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // --- DASHBOARD GURU ---
        if ($user->role === 'guru') {
            // 1. Total Siswa di kelas yang diajar (Misal Guru Kelas 4)
            // Asumsi: Guru punya kolom 'class_assigned' di tabel users, atau sementara ambil semua siswa dulu
            $querySiswa = Student::query();
            // if ($user->class_assigned) { $querySiswa->where('class_name', $user->class_assigned); }
            $totalSiswaKelolaan = $querySiswa->count();

            // 2. Total Tujuan Pembelajaran yang dibuat Guru ini
            $totalMateri = LearningGoal::where('created_by', $user->id)->count();
            $totalArtikel = Article::whereNotNull('published_at')->count();


            // 3. Siswa yang sakit/izin hari ini (Simulasi data)
            // Di real app, Anda butuh tabel daily_attendances, ini pakai summary dulu
            $siswaSakit = StudentAttendanceSummary::sum('sick');
            $siswaIzin = StudentAttendanceSummary::sum('permit');
            $siswaAlpa = StudentAttendanceSummary::sum('absent');
            $siswaHadir = StudentAttendanceSummary::sum('present');

            // 4. Siswa Terbaru (List ringkas)
            $recentStudents = $querySiswa->with('classroom')->latest()->limit(5)->get();

            return view('guru.dashboard.index', compact(
                'totalSiswaKelolaan',
                'totalMateri',
                'siswaSakit',
                'siswaIzin',
                'recentStudents',
                'totalArtikel',
                'siswaAlpa',
                'siswaHadir'
            ));
        }

        // --- DASHBOARD ADMIN (Code Lama) ---
        $totalSiswa = Student::count();
        $totalArtikel = Article::whereNotNull('published_at')->count();
        $totalOrangTua = User::where('role', 'wali')->where('status', 'active')->count();
        $totalPending = User::where('status', 'pending')->count();

        return view('admin.dashboard.index', compact(
            'totalSiswa',
            'totalArtikel',
            'totalOrangTua',
            'totalPending'
        ));
    }
}
