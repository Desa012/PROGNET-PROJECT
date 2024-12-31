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
        Schema::create('penjuals', function (Blueprint $table) {
            $table->id('id_penjual');
            $table->unsignedBigInteger('id_user');
            $table->string('nama_toko');
            $table->text('deskripsi_toko');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjuals');
    }
};
