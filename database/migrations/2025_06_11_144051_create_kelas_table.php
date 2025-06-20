<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            // relasi ke tabel users (guru)
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_kelas');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('kelas');
    }
};
