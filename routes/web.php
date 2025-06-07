<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    $lapangans = \App\Models\Lapangan::all();
    return view('welcome', compact('lapangans'));
});


// Form Pemesanan Routes
Route::get('/form_pemesanan', [PemesananController::class, 'create'])->name('pemesanans.index');
Route::get('/form_pemesanan/create', [PemesananController::class, 'create'])->name('pemesanans.create');
Route::post('/form_pemesanan/store', [PemesananController::class, 'store'])->name('pemesanans.store');
Route::get('/form_pemesanan/{pemesanan}/edit', [PemesananController::class, 'edit'])->name('pemesanans.edit'); 
Route::put('/form_pemesanan/{pemesanan}', [PemesananController::class, 'update'])->name('pemesanan.update'); 
Route::delete('/form_pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanans.destroy');


// Route untuk dashboard setelah login berdasarkan role
Route::middleware(['auth'])->group(function () {
    Route::get('/admin_welcome', [AdminController::class, 'index'])->name('admin.welcome');

    Route::get('/admin/pemesanan/create', [PemesananController::class, 'adminCreate'])->name('admin.pemesanan.create');
    Route::post('/admin/pemesanan/store', [PemesananController::class, 'adminStore'])->name('admin.pemesanan.store');

    Route::get('/welcome', function () {
        return view('welcome');
    })->name('user.welcome');
});
