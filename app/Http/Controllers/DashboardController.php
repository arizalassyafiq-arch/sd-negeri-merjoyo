<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total siswa aktif
        $totalSiswa = Student::count();

        // Total artikel yang sudah publish
        $totalArtikel = Article::whereNotNull('published_at')->count();

        // Total orang tua (wali) yang aktif
        $totalOrangTua = User::where('role', 'wali')
            ->where('status', 'active')
            ->count();

        // Total user pending (biasanya wali)
        $totalPending = User::where('status', 'pending')->count();

        return view('admin.dashboard.index', compact(
            'totalSiswa',
            'totalArtikel',
            'totalOrangTua',
            'totalPending'
        ));
    }
}
