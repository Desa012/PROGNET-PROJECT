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
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id('id_pengiriman');
            $table->unsignedbigInteger('id_pesanan');
            $table->enum('status_pengiriman',['dikemas', 'dikirim', 'selesai']);
            $table->dateTime('tanggal_pengiriman')->nullable();
            $table->dateTime('tanggal_diterima')->nullable();
            $table->string('no_resi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};
