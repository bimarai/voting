<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kandidat';  // Pastikan menggunakan primary key yang benar

    protected $table = 'kandidat';  // Nama tabel

    public $timestamps = false;  // Jika tabel tidak menggunakan timestamps

    protected $fillable = [
        'nama_kandidat',
        'id_setting',
        'foto',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat',
        'nomor_urut',
       
    ];
}
