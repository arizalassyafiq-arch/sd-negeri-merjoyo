<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\Admin\UserApprovalController;

// ===== PUBLIC ROUTES =====
Route::view('/', 'welcome')->name('welcome');

// Search Page
Route::get('/search', function () {
    return view('pages.search.index');
});

// Artikel Public
Route::get('/artikel', [PublicArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [PublicArticleController::class, 'show'])->name('artikel.show');

// ===== GUEST (AUTH) ROUTES =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// ===== AUTHENTICATED ROUTES (Login Required) =====
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Redirect (Sesuai Role)
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // === PROFILE SETTINGS (Bisa diakses Admin & Wali) ===
    // Route ini memanggil ProfileController@edit yang sudah kita modifikasi
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    // Opsional: Hapus Akun
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== ADMIN SPECIFIC ROUTES =====
// Hanya bisa diakses oleh user dengan role 'admin'
Route::prefix('admin')->name('admin.')->middleware(['auth', 'checkRole:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Artikel Management
    Route::resource('artikel', ArticleController::class);

    // Approval Wali Murid
    Route::prefix('wali')->name('wali.')->group(function () {
        Route::get('/', [UserApprovalController::class, 'index'])->name('index'); // Pending
        Route::get('/active', [UserApprovalController::class, 'active'])->name('active'); // Aktif
        Route::get('/rejected', [UserApprovalController::class, 'rejected'])->name('rejected'); // Ditolak

        // Actions
        Route::patch('/{user}/approve', [UserApprovalController::class, 'approve'])->name('approve');
        Route::patch('/{user}/reject', [UserApprovalController::class, 'reject'])->name('reject');
        Route::delete('/{user}', [UserApprovalController::class, 'destroy'])->name('destroy');
    });
});
