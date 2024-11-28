<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kandidat'; // Sesuaikan dengan nama kolom primary key
    public $incrementing = false; // Jika kolom bukan integer auto-increment
    protected $keyType = 'string'; // Sesuaikan tipe data jika bukan integer
    protected $table = 'kandidat';
}
