<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route yang sudah ada: untuk menampilkan halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// --- Route yang baru ditambahkan: untuk dashboard Admin & User ---
// Route yang hanya bisa diakses setelah pengguna login
Route::middleware(['auth'])->group(function () {

    // Route untuk Halaman Admin (hanya bisa diakses oleh role 'admin')
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    });

    // Route untuk Halaman User (hanya bisa diakses oleh role 'user')
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    });

    // Route Dashboard umum yang mengarahkan ke dashboard spesifik
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});