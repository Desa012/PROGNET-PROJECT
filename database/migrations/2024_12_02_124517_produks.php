<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedbigInteger('id_penjual');
            $table->unsignedbigInteger('id_kategori');
            $table->string('nama_produk');
            $table->text('deskripsi_produk');
            $table->binary('gambar_produk');
            $table->float('harga');
            $table->integer('stok');
            $table->timestamps();

            // $table->foreign('id_penjual')->references('id_penjual')->on('penjuals')->onDelete('cascade');

            // $table->foreign('id_kategori')->references('id_kategori')->on('kategori_produks')->onDelete('cascade');

            // $table->foreign('id_diskon')->references('id_diskon')->on('diskons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
