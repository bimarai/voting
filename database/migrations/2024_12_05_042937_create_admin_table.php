<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis
            $table->string('username')->unique(); // Username unik
            $table->string('email')->unique(); // Email unik
            $table->string('password'); // Password hashed
            $table->string('nama_lengkap'); // Nama lengkap admin
            $table->date('tanggal_lahir'); // Tanggal lahir
            $table->string('nik')->unique(); // NIK unik
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
