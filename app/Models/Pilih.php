<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilih extends Model
{
    use HasFactory;
    protected $table = 'kandidat';

    public $timestamps = false;

    protected $fillable = [
        'id_pemilihan',
        'id_kandidat'
    ];
}