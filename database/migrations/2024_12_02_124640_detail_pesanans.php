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
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedbigInteger('id_pesanan');
            $table->unsignedbigInteger('id_produk');
            $table->integer('jumlah');
            $table->float('subtotal');
            $table->timestamps();

            // $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanans')->onDelete('cascade');

            // $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};
