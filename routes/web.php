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
use App\Http\Middleware\CheckToken;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk user dengan middleware CheckToken
Route::middleware([CheckToken::class])->group(function () {
    // Halaman Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/votingApp', PilihController::class);

    // Halaman About
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');

    // Rute untuk halaman Thanks
    Route::get('/Thanks', function () {
        return view('Thanks', ['name' => 'Thanks']);
    })->name('Thanks');
    
    // Proses penyimpanan voting
    Route::post('/pilih/{id_kandidat}', [PilihController::class, 'store'])->name('votingApp.store');
});

// Rute untuk login token
Route::get('/sesi', [SessionController::class, 'index'])->name('sesi.index');
Route::post('/sesi/login', [SessionController::class, 'login']);
Route::post('/sesi/logout', [SessionController::class, 'logout'])->name('logout');

// ==========================
// Rute Dashboard Admin

// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk Register Admin
Route::get('/register/admin', [AuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/register/admin', [AuthController::class, 'registerAdmin'])->name('admin.store');

// Rute dengan middleware AuthenticateAdmin
Route::middleware('App\Http\Middleware\CheckLogin')->group(function () {
    // Halaman Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard/index', ['name' => 'Dashboard']);
    });

    // Halaman profil admin
    Route::get('/dashboard/profile', [AuthController::class, 'index'])->name('profile');

    // Rute untuk kandidat
    Route::resource('dashboard/kandidats', KandidatController::class);

    // Rute untuk pengaturan
    Route::resource('dashboard/settings', SettingController::class);
    Route::post('dashboard/admin/store', [SettingController::class, 'store'])->name('admin.store');

    // Rute untuk token
    Route::get('dashboard/generate', [TokenController::class, 'index'])->name('generate.index');
    Route::post('dashboard/generate', [TokenController::class, 'store'])->name('generate.store');
    Route::delete('dashboard/generate/delete-all', [TokenController::class, 'deleteAll'])->name('generate.deleteAll');

    // Hasil voting dan penghapusan data
    Route::get('dashboard/hasil-voting', [PilihController::class, 'hasilVoting'])->name('hasil.voting');
    Route::delete('dashboard/hapus-data-pemilihan', [PilihController::class, 'hapusSemuaData'])->name('hapus.data.pemilihan');
});

// ==========================
// Rute tanpa middleware

// Fitur pencarian kandidat
Route::get('/kandidat/search', [KandidatController::class, 'search'])->name('kandidat.search');

// Halaman Thanks (jika ingin bebas akses tanpa middleware)
Route::get('/Thanks', function () {
    return view('Thanks', ['name' => 'Thanks']);
})->name('Thanks');
