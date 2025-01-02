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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->unsignedbigInteger('id_user');
            $table->unsignedbigInteger('id_penjual');
            $table->unsignedbigInteger('id_alamat');
            $table->unsignedbigInteger('id_metode');
            $table->datetime('tanggal_pesanan');
            $table->enum('status', ['sudah bayar', 'belum bayar']);
            $table->float('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
