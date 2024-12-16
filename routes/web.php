<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PilihController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;

// ==========================
// Route tanpa middleware
Route::get('/', fn() => redirect('/home'));
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ==========================
// Halaman About
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// ==========================
// Route dengan middleware CheckToken
Route::middleware(['CheckToken'])->group(function () {
    Route::resource('/votingApp', PilihController::class);
    Route::post('/pilih/{id_kandidat}', [PilihController::class, 'store'])->name('votingApp.store');
});

// ==========================
// Rute untuk sesi login token
Route::get('/sesi', [SessionController::class, 'index'])->name('sesi.index');
Route::post('/sesi/login', [SessionController::class, 'login'])->name('sesi.login');
Route::post('/sesi/logout', [SessionController::class, 'logout'])->name('sesi.logout');

// ==========================
// Rute Auth (Login, Register, Logout) Admin
Route::middleware(['guest'])->group(function () {
    // Halaman login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');

    // Halaman register admin
    Route::get('/register/admin', [AuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register/admin', [AuthController::class, 'registerAdmin'])->name('admin.store');
});

// Logout admin
Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');

// ==========================
// Route Dashboard Admin
Route::middleware(['auth:admin'])->prefix('dashboard')->group(function () {
    // Dashboard utama
    Route::get('/', fn() => view('dashboard.index', ['name' => 'Dashboard']))->name('dashboard.index');

    // Halaman profil admin
    Route::get('/profile', [AuthController::class, 'index'])->name('dashboard.profile');

    // Resource route kandidat
    Route::resource('kandidats', KandidatController::class);

    // Resource route pengaturan
    Route::resource('settings', SettingController::class);
    Route::post('/admin/store', [SettingController::class, 'store'])->name('dashboard.admin.store');

    // Route untuk generate token
    Route::get('/generate', [TokenController::class, 'index'])->name('dashboard.generate.index');
    Route::post('/generate', [TokenController::class, 'store'])->name('dashboard.generate.store');
    Route::delete('/generate/delete-all', [TokenController::class, 'deleteAll'])->name('dashboard.generate.deleteAll');

    // Route hasil voting dan hapus data pemilihan
    Route::get('/hasil-voting', [PilihController::class, 'hasilVoting'])->name('dashboard.hasil.voting');
    Route::delete('/hapus-data-pemilihan', [PilihController::class, 'hapusSemuaData'])->name('dashboard.hapus.data.pemilihan');
});

// ==========================
// Fitur Pencarian Kandidat
Route::get('/kandidat/search', [KandidatController::class, 'search'])->name('kandidat.search');

// ==========================
// Halaman Thanks
Route::get('/Thanks', fn() => view('Thanks', ['name' => 'Thanks']))->name('thanks.index');
