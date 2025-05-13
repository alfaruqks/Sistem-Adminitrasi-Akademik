<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('murid_id'); // Relasi ke murid
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->decimal('jumlah', 10, 2);
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
            $table->timestamps();
            $table->foreign('murid_id')->references('id')->on('users')->onDelete('cascade');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagihan_pembayaran');
    }
};
