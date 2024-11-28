<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SettingController extends Controller
{
    public function edit(Setting $setting)
    {
        $name = 'Edit Setting';
        return view('Setting', compact('setting', 'name'));
    }

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
            if ($setting->logo && file_exists(public_path('assets/' . $setting->logo))) {
                unlink(public_path('assets/' . $setting->logo)); // Hapus logo lama
            }

            // Upload file logo baru
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets'), $filename);  // Pindahkan file logo ke folder assets

            // Menambahkan file logo ke data yang akan diupdate
            $data['logo'] = $filename;
        }

        // Update data setting
        $setting->update($data);

        // Redirect ke halaman edit setting dengan pesan sukses
        return redirect()->route('settings.edit', $setting->id_setting)
            ->with('success', 'Setting updated successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required|numeric',
            'email' => 'required|email',
            'username' => 'required|unique:admin,username',
            'password' => 'required|min:8|confirmed', // Ensures password is confirmed
        ]);

        $admin = new Admin();
        $admin->nama_lengkap = $request->nama_lengkap;
        $admin->tanggal_lahir = $request->tanggal_lahir;
        $admin->nik = $request->nik;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = $request->password; // Hash the password before saving
        $admin->save();

        return redirect()->route('dashboard/admin.index')->with('success', 'Admin added successfully!');
    }
}
