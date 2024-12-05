<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // Menampilkan halaman edit setting
    public function edit(Setting $setting)
    {
        $name = 'Edit Setting';
        return view('Setting', compact('setting', 'name'));
    }

    // Update pengaturan
    public function update(Request $request, Setting $setting)
    {
        // Validasi input
        $request->validate([
            'nama_setting' => 'required|string|max:255',
            'judul_pemilihan' => 'required|string|max:255',
            'limit_voting_min' => 'required|integer',
            'limit_voting_max' => 'required|integer',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk logo
        ]);

        // Data yang akan diupdate
        $data = $request->only([
            'nama_setting',
            'judul_pemilihan',
            'limit_voting_min',
            'limit_voting_max',
            'tgl_awal',
            'tgl_akhir',
        ]);

        // Handle file upload logo
        if ($request->hasFile('logo')) {
            // Cek dan hapus logo lama jika ada
            if ($setting->logo && Storage::exists('public/assets/' . $setting->logo)) {
                Storage::delete('public/assets/' . $setting->logo); // Hapus logo lama
            }

            // Upload file logo baru
            $path = $request->file('logo')->store('assets', 'public');  // Menyimpan di public/storage/assets

            // Menambahkan file logo ke data yang akan diupdate
            $data['logo'] = basename($path);  // Menyimpan nama file saja
        }

        // Update data setting
        $setting->update($data);

        // Redirect ke halaman edit setting dengan pesan sukses
        return redirect()->route('settings.edit', $setting->id_setting)
            ->with('success', 'Setting updated successfully');
    }

    // Menambahkan admin baru
    public function store(Request $request)
    {
        // Validasi input admin
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required|numeric|digits:16|unique:,nik', // Validasi nik unik
            'email' => 'required|email|unique:,email',         // Validasi email unik
            'username' => 'required|string|max:50|unique:,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat admin baru
        $admin = new Admin();
        $admin->nama_lengkap = $request->nama_lengkap;
        $admin->tanggal_lahir = $request->tanggal_lahir;
        $admin->nik = $request->nik;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password); // Hash password sebelum disimpan
        $admin->save();

        // Redirect ke halaman daftar admin dengan pesan sukses
        return redirect()->route('dashboard/kandidats.index')->with('success', 'Admin added successfully!');
    }
}
