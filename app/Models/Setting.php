<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_setting';
    protected $table = 'setting';
    public $timestamps = false; // Jika tabel tidak memiliki kolom timestamps

    protected $fillable = [
        'nama_setting',
        'judul_pemilihan',
        'limit_voting_min',
        'limit_voting_max',
        'tgl_awal',
        'tgl_akhir',
        'logo',
        // 'is_aktif',
    ];
}
