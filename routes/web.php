<?php

// admin
use Illuminate\Support\Facades\Route;
// end

//public
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserApprovalController;
use App\Http\Controllers\Admin\ArticleController;

Route::get('/', function () {
    return view('welcome');
});
// ===== AUTH =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

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
        Route::get('/dashboard', function () {
            return view('admin.dashboard.dashboard');
        })->name('dashboard');

        // === APPROVAL WALI ===
        Route::get('/wali', [UserApprovalController::class, 'index'])
            ->name('wali.index');

        Route::patch('/wali/{user}/approve', [UserApprovalController::class, 'approve'])
            ->name('wali.approve');

        Route::patch('/wali/{user}/reject', [UserApprovalController::class, 'reject'])
            ->name('wali.reject');
    });


Route::get('/artikel', [PublicArticleController::class, 'index'])->name('artikel.index');

Route::get('/artikel/{slug}', [PublicArticleController::class, 'show'])->name('artikel.show');


// Route::view('/login', 'auth.login')->name('login');
// Route::view('/register', 'auth.register')->name('register');