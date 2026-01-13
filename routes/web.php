<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\AcademicManagementController;
use App\Http\Controllers\Admin\UserApprovalController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/

Route::view('/', 'dashboard')->name('home');
Route::get('/search', fn() => view('pages.search.index'));

// Artikel
Route::get('/artikel', [PublicArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [PublicArticleController::class, 'show'])->name('artikel.show');

/*
|--------------------------------------------------------------------------
| 2. GUEST ROUTES (Hanya untuk yang BELUM login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| 3. AUTHENTICATED SHARED ROUTES (Semua User Login)
|--------------------------------------------------------------------------
| Admin, Super Admin, Guru, Wali, Siswa masuk sini.
| URL tidak ada embel-embel 'admin' atau 'guru'.
*/
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Smart Redirect (Controller yang menentukan arah)
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Profile Settings (Sama untuk semua role)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

/*
|--------------------------------------------------------------------------
| 4. ADMIN & SUPER ADMIN ROUTES
|--------------------------------------------------------------------------
| URL: localhost:8000/admin/....
| Middleware: Mengecek apakah user adalah 'admin' ATAU 'super_admin'
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'checkRole:admin,guru'])
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('teachers', TeacherController::class);
        // --- MANAJEMEN SISWA (Full Akses CRUD) ---
        // URL: /admin/students
        Route::resource('students', StudentController::class);

        // --- AKADEMIK (Nilai, Absensi, dll) ---
        // URL: /admin/academic/...
        Route::prefix('academic')->name('academic.')->group(function () {
            Route::get('/', [AcademicManagementController::class, 'index'])->name('index');
            Route::get('/students/{student}', [AcademicManagementController::class, 'show'])->name('students.show');

            // Aksi-aksi Form
            Route::post('/students/{student}/attendance', [AcademicManagementController::class, 'storeAttendance'])->name('students.attendance.store');
            Route::post('/students/{student}/goals', [AcademicManagementController::class, 'storeGoal'])->name('students.goals.store');
            Route::post('/students/{student}/outcomes', [AcademicManagementController::class, 'storeOutcome'])->name('students.outcomes.store');
            Route::post('/students/{student}/notes', [AcademicManagementController::class, 'storeNote'])->name('students.notes.store');
        });


        // --- MANAJEMEN ARTIKEL ---
        Route::resource('artikel', ArticleController::class);

        // --- APPROVAL WALI MURID ---
        Route::prefix('wali')->name('wali.')->group(function () {
            Route::get('/', [UserApprovalController::class, 'index'])->name('index');
            Route::get('/active', [UserApprovalController::class, 'active'])->name('active');
            Route::get('/rejected', [UserApprovalController::class, 'rejected'])->name('rejected');

            Route::patch('/{user}/approve', [UserApprovalController::class, 'approve'])->name('approve');
            Route::patch('/{user}/reject', [UserApprovalController::class, 'reject'])->name('reject');
            Route::delete('/{user}', [UserApprovalController::class, 'destroy'])->name('destroy');
        });
    });

/*
|--------------------------------------------------------------------------
| 5. GURU ROUTES
|--------------------------------------------------------------------------
| URL: localhost:8000/guru/....
| Middleware: Hanya 'guru'
*/
Route::prefix('guru')
    ->name('guru.')
    ->middleware(['auth', 'checkRole:guru'])
    ->group(function () {

        // Dashboard Guru
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // --- AKADEMIK GURU ---
        // Kita tulis ulang disini agar jelas. 
        // URL: /guru/academic/...
        Route::prefix('academic')->name('academic.')->group(function () {
            Route::get('/', [AcademicManagementController::class, 'index'])->name('index');

            // Guru HANYA bisa melihat detail, tidak bisa Delete siswa (karena tidak ada resource student)
            Route::get('/students/{student}', [AcademicManagementController::class, 'show'])->name('students.show');

            // Guru bisa input nilai & absen (Sama fungsinya dengan admin)
            Route::post('/students/{student}/attendance', [AcademicManagementController::class, 'storeAttendance'])->name('students.attendance.store');
            Route::post('/students/{student}/goals', [AcademicManagementController::class, 'storeGoal'])->name('students.goals.store');
            Route::post('/students/{student}/outcomes', [AcademicManagementController::class, 'storeOutcome'])->name('students.outcomes.store');
            Route::post('/students/{student}/notes', [AcademicManagementController::class, 'storeNote'])->name('students.notes.store');
        });
    });
