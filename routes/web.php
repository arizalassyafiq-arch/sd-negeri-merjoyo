<?php

// admin
use Illuminate\Support\Facades\Route;
// end

//public
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\Admin\UserApprovalController;

Route::view('/', 'welcome')->name('welcome');

// ===== AUTH =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
// ===== END AUTH ===== 

Route::get('/search', function () {
    return view('pages.search.index');
});


Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

// Pastikan ini ada di dalam group middleware auth dan role admin jika ada
Route::prefix('admin')->name('admin.')->middleware(['auth']) // nanti bisa tambah role:admin
    ->group(function () {
        // Artikel
        Route::resource('artikel', ArticleController::class);

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // === APPROVAL WALI ===
        Route::get('/wali', [UserApprovalController::class, 'index'])
            ->name('wali.index');

        Route::get('/wali/active', [UserApprovalController::class, 'active'])->name('wali.active');

        Route::get('/wali/rejected', [UserApprovalController::class, 'rejected'])->name('wali.rejected');

        Route::patch('/wali/{user}/approve', [UserApprovalController::class, 'approve'])
            ->name('wali.approve');
        Route::patch('/wali/{user}/reject', [UserApprovalController::class, 'reject'])
            ->name('wali.reject');

        // Action Delete (Opsional: Untuk menghapus permanen user yang ditolak)
        Route::delete('/wali/{user}', [UserApprovalController::class, 'destroy'])->name('wali.destroy');
    });


Route::get('/artikel', [PublicArticleController::class, 'index'])->name('artikel.index');

Route::get('/artikel/{slug}', [PublicArticleController::class, 'show'])->name('artikel.show');


// Route::view('/login', 'auth.login')->name('login');
// Route::view('/register', 'auth.register')->name('register');