<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ResponController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/masuk', [AuthenticationController::class, 'login'])->name('login');
Route::post('/masuk', [AuthenticationController::class, 'authenticate'])->name('authenticate');
Route::post('/daftar', [AuthenticationController::class, 'register'])->name('register');

Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    
    Route::get('/respon', [ResponController::class, 'index'])->name('respon');
    
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/', [DashboardController::class, 'search'])->name('search');
    Route::post('/keluar', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/lihat-pengaduan/{id}', [DashboardController::class, 'show'])->name('show');
    
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
    Route::get('/pengaduan/buat-pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    
    Route::post('/pengaduan/reply', [ResponController::class, 'balas'])->name('pengaduan.reply');
    
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

    Route::get('/profil', [UserController::class, 'profile'])->name('profile');
});



// Route::get('/respon/show/{id}', [ResponController::class, 'show'])->name('respon.show');
