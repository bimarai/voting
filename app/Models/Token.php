<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    // protected $primaryKey = 'token';
    protected $table = 'token';
    // Menonaktifkan timestamps
    public $timestamps = false;
    protected $fillable = [
        'token',
        'id_setting',
        'is_pakai',
    ];
}
