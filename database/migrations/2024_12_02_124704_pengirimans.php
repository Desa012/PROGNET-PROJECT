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
            $table->enum('status_pengiriman',['sudah dikirim', 'dalam perjalanan', 'belum dikirim']);
            $table->date('tanggal_pengiriman');
            $table->date('tanggal_diterima');
            $table->string('no_resi');
            $table->timestamps();

            // $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanans')->onDelete('cascade');
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
