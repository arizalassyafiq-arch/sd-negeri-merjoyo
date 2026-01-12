<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\Admin\UserApprovalController;

// ==========================================
// PUBLIC ROUTES (Bisa diakses siapa saja)
// ==========================================

Route::view('/', 'dashboard')->name('home');

// Search Page
Route::get('/search', function () {
    return view('pages.search.index');
});

// Artikel Public
Route::get('/artikel', [PublicArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [PublicArticleController::class, 'show'])->name('artikel.show');


// ==========================================
// GUEST ROUTES (Hanya untuk yang belum login)
// ==========================================
// Route::middleware('guest')->group(function () {
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
// });


// ==========================================
// AUTH ROUTES (Harus Login: Admin, Guru, Wali)
// ==========================================
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Redirect (Mengarahkan sesuai role)
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});


// ==========================================
// ADMIN ROUTES (Khusus Role Admin)
// ==========================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'checkRole:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 1. MANAGEMENT SISWA (CRUD LENGKAP)
    // Ini otomatis membuat route: index, create, store, edit, update, destroy
    // URL: /admin/students
    // Route Name: admin.students.index, admin.students.create, dst.
    Route::resource('students', StudentController::class)->except(['show']);

    // 2. MANAGEMENT ARTIKEL
    Route::resource('artikel', ArticleController::class);

    // 3. APPROVAL WALI MURID
    Route::prefix('wali')->name('wali.')->group(function () {
        Route::get('/', [UserApprovalController::class, 'index'])->name('index'); // Pending list
        Route::get('/active', [UserApprovalController::class, 'active'])->name('active'); // Active list
        Route::get('/rejected', [UserApprovalController::class, 'rejected'])->name('rejected'); // Rejected list

        // Actions (Tombol Approve/Reject)
        Route::patch('/{user}/approve', [UserApprovalController::class, 'approve'])->name('approve');
        Route::patch('/{user}/reject', [UserApprovalController::class, 'reject'])->name('reject');
        Route::delete('/{user}', [UserApprovalController::class, 'destroy'])->name('destroy');
    });
});
