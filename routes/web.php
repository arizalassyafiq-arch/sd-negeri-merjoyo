<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicArticleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', function () {
    return view('pages.search-page');
});

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');


// Pastikan ini ada di dalam group middleware auth dan role admin jika ada
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('artikel', ArticleController::class);
    Route::get('/dashboard', function () {
        return view('admin.dashboard.dashboard');
    })->name('dashboard');
});


// Halaman Daftar Artikel


Route::get('/artikel', [PublicArticleController::class, 'index'])->name('artikel.index');



// Halaman Detail Artikel (Pastikan ditaruh di bawah agar tidak konflik dengan route lain)
Route::get('/artikel/{slug}', [PublicArticleController::class, 'show'])->name('artikel.show');

// Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
// Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('artikel', AdminArticleController::class)->except(['show']);
// });