<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use Notifiable;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'admin'; // Pastikan ini sesuai dengan nama tabel di database

    // Nonaktifkan timestamps karena kolom created_at dan updated_at tidak ada
    public $timestamps = false;

    // Daftar kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'username',
        'email',
        'password',
        'nama_lengkap',
        'tanggal_lahir',
        'nik',
    ];

    // Kolom yang harus disembunyikan saat data diubah menjadi array atau JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mutator untuk enkripsi password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Contoh fungsi accessor untuk nama lengkap (opsional)
    public function getNamaLengkapAttribute($value)
    {
        return ucfirst($value); // Kapitalisasi nama lengkap
    }

    // Contoh fungsi mutator untuk username (opsional)
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value); // Simpan username dalam huruf kecil
    }
}
