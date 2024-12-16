<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    // Menampilkan halaman profil admin
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('login')->with('pesan', 'Anda harus login terlebih dahulu.');
        }

        $name = 'Profile Admin';
        return view('dashboard.profile', compact('admin', 'name'));
    }

    // Menampilkan halaman login
    public function showLoginForm()
    {
        $name = 'Login Admin';
        return view('auth.login', compact('name'));
    }

    // Proses login admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke dashboard admin
            return redirect()->intended(route('dashboard.index'));
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('pesan', 'Anda berhasil logout.');
    }

    // Menampilkan halaman registrasi admin
    public function showRegisterForm()
    {
        $name = 'Register Admin';
        return view('auth.register', compact('name'));
    }

    // Proses registrasi admin
    public function registerAdmin(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required|numeric|digits:16|unique:admin,nik',
            'email' => 'required|email|unique:admin,email',
            'username' => 'required|string|max:255|unique:admin,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nik' => $request->nik,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('pesan', 'Registrasi berhasil. Silakan login.');
    }
}
