<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AuthController extends Controller
{

    public function index()
    {
        // Ambil data pengguna yang sedang login
        $admin = Auth::guard('admin')->user();

        // Pastikan $admin tidak null
        if (!$admin) {
            return redirect('/login')->with('pesan', 'Anda harus login terlebih dahulu.');
        }

        $name = 'Profile Admin';

        // Tampilkan profil pengguna ke view
        return view('Dashboard.Profile', compact('admin', 'name'));
    }


    public function showLoginForm()
    {
        $name = 'Login Admin';
        $pesan = '';
        return view('auth.login', compact('name', 'pesan'));
    }

    public function login(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari admin berdasarkan email
        $admin = Admin::where('email', $credentials['email'])->first();

        // Jika admin ditemukan dan password cocok
        if ($admin && $admin->password === $credentials['password']) {
            Auth::guard('admin')->login($admin);  // Login secara manual
            return redirect()->intended('dashboard');
        }
        $pesan = ' Email / Password salah';
        $name = ' Login Admin';

        // Jika login gagal
        return view('auth/login', compact('name', 'pesan'));
    }

    public function logout(Request $request)
    {
        // Logout dari guard admin
        Auth::guard('admin')->logout();

        // Hapus session
        $request->session()->invalidate();

        // Regenerasi session untuk keamanan
        $request->session()->regenerateToken();

        // Redirect ke halaman login dengan pesan
        return redirect('/login')->with('pesan', 'Anda berhasil logout.');
    }
}