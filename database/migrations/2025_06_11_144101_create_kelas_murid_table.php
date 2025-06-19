<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas_murid', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('murid_id')->constrained('users')->onDelete('cascade');
            $table->unique(['kelas_id', 'murid_id']); // mencegah duplikasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas_murid');
    }
};
