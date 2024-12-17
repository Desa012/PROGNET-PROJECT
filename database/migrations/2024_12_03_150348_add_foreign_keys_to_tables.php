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
        Schema::table('produks', function (Blueprint $table) {
            $table->unsignedbigInteger('id_penjual')->change();
            $table->foreign('id_penjual')->references('id_penjual')->on('penjuals')->onDelete('cascade');

            $table->unsignedbigInteger('id_kategori')->change();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_produks')->onDelete('cascade');

            $table->unsignedbigInteger('id_diskon')->change();
            $table->foreign('id_diskon')->references('id_diskon')->on('diskons')->onDelete('cascade');
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->unsignedbigInteger('id_pelanggan')->change();
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');
        });

        Schema::table('detail_pesanans', function (Blueprint $table) {
            $table->unsignedbigInteger('id_pesanan')->change();
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanans')->onDelete('cascade');

            $table->unsignedbigInteger('id_produk')->change();
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
        });

        Schema::table('pengirimans', function (Blueprint $table) {
            $table->unsignedbigInteger('id_pesanan')->change();
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanans')->onDelete('cascade');
        });

        Schema::table('ulasans', function (Blueprint $table) {
            $table->unsignedbigInteger('id_produk')->change();
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
        });

        Schema::table('keranjangs', function(Blueprint $table) {
            $table->unsignedbigInteger('id_pelanggan')->change();
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');

            $table->unsignedbigInteger('id_produk')->change();
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign(['id_penjual']);
            $table->dropForeign(['id_kategori']);
            $table->dropForeign(['id_diskon']);
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropForeign(['id_pelanggan']);
        });

        Schema::table('detail_pesanans', function (Blueprint $table) {
            $table->dropForeign(['id_pesanan']);
            $table->dropForeign(['id_produk']);
        });

        Schema::table('pengirimans', function (Blueprint $table) {
            $table->dropForeign(['id_pesanan']);
        });

        Schema::table('ulasans', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
        });
    }
};
