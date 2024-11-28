<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'nama_lengkap', // Tambahkan
        'tanggal_lahir', // Tambahkan
        'nik', // Tambahkan
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
