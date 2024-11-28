<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilihanDetail extends Model
{
    use HasFactory;
    protected $table = 'pemilihan_detail';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'id_pemilihan',
        'id_kandidat',
    ];

    public $timestamps = false; // Jika tabel tidak memiliki kolom timestamps
}
