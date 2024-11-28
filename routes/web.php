<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PilihController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Middleware\TokenMiddleware;
use App\Http\Middleware\CheckToken;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([CheckToken::class])->group(function () {
    Route::resource('/home',  HomeController::class);
    Route::get('/about', [AboutController::class, 'index']);
    
    // Hanya tambahkan rute /Thanks dalam grup middleware jika membutuhkan autentikasi token
    Route::get('/Thanks', function () {
        return view('Thanks', ['name' => 'Thanks']);
    });

    Route::resource('/votingApp', PilihController::class);
    Route::post('/pilih/{id_kandidat}', [PilihController::class, 'store'])->name('votingApp.store');
});

// Route untuk login token
Route::get('/sesi', [SessionController::class, 'index'])->name('sesi.index');
Route::post('/sesi/login', [SessionController::class, 'login']);
Route::post('/sesi/logout', [SessionController::class, 'logout'])->name('logout');

// ==========================
// Route Dashboard Admin
// halaman profil

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang membutuhkan middleware AuthenticateAdmin
Route::middleware('App\Http\Middleware\CheckLogin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard/index', ['name' => 'Dashboard']);
    });

    // Perbaiki rute /profile untuk menampilkan profil admin yang login
    Route::get('dashboard/profile', [AuthController::class, 'index'])->name('profile');

    Route::resource('dashboard/kandidats', KandidatController::class);
    Route::resource('dashboard/settings', SettingController::class);
    Route::post('dashboard/admin/store', [SettingController::class, 'store'])->name('admin.store');

    Route::get('dashboard/generate', [TokenController::class, 'index'])->name('generate.index');
    Route::post('dashboard/generate', [TokenController::class, 'store'])->name('generate.store');
    Route::delete('dashboard/generate/delete-all', [TokenController::class, 'deleteAll'])->name('generate.deleteAll');
    Route::get('dashboard/hasil-voting', [PilihController::class, 'hasilVoting'])->name('hasil.voting');
    Route::delete('dashboard/hapus-data-pemilihan', [PilihController::class, 'hapusSemuaData'])->name('hapus.data.pemilihan');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
});

// Rute tanpa middleware
Route::get('/kandidat/search', [KandidatController::class, 'search'])->name('kandidat.search');

// Rute /Thanks di luar grup middleware jika ingin bebas diakses tanpa token
// Pastikan hanya ada satu definisi rute untuk /Thanks
// Hapus baris ini jika Anda sudah menambahkannya di dalam grup middleware.
Route::get('/Thanks', function () {
    return view('Thanks', ['name' => 'Thanks']);
})->name('Thanks');
