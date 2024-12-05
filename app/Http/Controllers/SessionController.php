<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;

class SessionController extends Controller
{
    public function index()
    {
        $name = 'Halaman Login';
        $pesan = '';
        return view("sesi.index", compact('name', 'pesan'));
    }

    public function login(Request $request)
{
    // Validasi token input
    $validatedData = $request->validate([
        'token' => 'required|string|max:255',
    ]);

    // Temukan token yang valid (is_pakai = 2)
    $data = Login::where('token', $validatedData['token'])->where('is_pakai', 2)->first();

    if ($data) {
        // Tandai token sebagai digunakan (is_pakai = 1)
        $data->update(['is_pakai' => 1]);

        // Simpan token di session
        session()->put('user_token', $validatedData['token']);

        // Redirect ke halaman voting
        return redirect()->route('votingApp.index');
    } else {
        // Jika token tidak valid atau kadaluarsa
        $name = 'Halaman Login';
        $pesan = 'Token tidak valid atau sudah digunakan.';
        return view("sesi.index", compact('name', 'pesan'));
    }
}


    public function logout()
    {
        // Remove the token from the session to log the user out
        session()->forget('user_token');

        // Redirect to the login page
        return redirect()->route('sesi.index')->with('pesan', 'Anda berhasil logout');
    }
}
