<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;  // Pastikan untuk menggunakan hash saat menyimpan password

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    public $timestamps = false;  // Atur sesuai kebutuhan

    protected $fillable = [
        'username',
        'email',
        'password',
        'nama_lengkap',
        'tanggal_lahir',
        'nik',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Jika Anda ingin meng-hash password sebelum disimpan ke database
    public static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            // Enkripsi password sebelum disimpan ke database
            if ($admin->password) {
                $admin->password = Hash::make($admin->password);
            }
        });
    }

    // Jika Anda ingin menambahkan cast, Anda bisa mengaktifkan bagian ini
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
