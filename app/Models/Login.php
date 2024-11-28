<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Login extends Model
{
    use HasFactory;
    protected $primaryKey = 'token'; // Menggunakan 'token' sebagai primary key
    public $incrementing = false; // Nonaktifkan auto-increment karena 'token' bukan integer
    protected $keyType = 'string'; // Tentukan tipe data primary key sebagai string

    protected $table = 'token';
    public $timestamps = false;

    protected $fillable = [
        'token',
        'is_pakai',
        'user_id'
    ];
}
