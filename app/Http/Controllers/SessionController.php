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
        $validatedData = $request->validate([
            'token' => 'required|string|max:255',
        ]);

        // Temukan token yang valid (is_pakai = 2)
        $data = Login::where('token', $validatedData['token'])->where('is_pakai', 2)->first();

        if ($data) {
            // Mark token sebagai digunakan (is_pakai = 1) ketika login
            $data->is_pakai = 1;
            $data->save();

            // Simpan token di session
            session()->put('user_token', $validatedData['token']);

            return redirect()->action([HomeController::class, 'index']);
        } else {
            $name = 'Halaman Login';
            $pesan = 'Token tidak Valid / Kadaluarsa';
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
