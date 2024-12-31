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
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->unsignedbigInteger('id_user')->change();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');

            $table->unsignedbigInteger('id_penjual')->change();
            $table->foreign('id_penjual')->references('id_penjual')->on('penjuals')->onDelete('cascade');

            $table->unsignedbigInteger('id_alamat')->change();
            $table->foreign('id_alamat')->references('id_alamat')->on('alamats')->onDelete('cascade');

            $table->unsignedbigInteger('id_metode')->change();
            $table->foreign('id_metode')->references('id_metode')->on('metode_pembayarans')->onDelete('cascade');
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

        Schema::table('diskons', function (Blueprint $table) {
            $table->unsignedbigInteger('id_penjual')->change();
            $table->foreign('id_penjual')->references('id_penjual')->on('penjuals')->onDelete('cascade');
        });

        Schema::table('alamats', function (Blueprint $table) {
            $table->unsignedbigInteger('id_user')->change();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });

        Schema::table('produk_diskons', function (Blueprint $table) {
            $table->unsignedbigInteger('id_produk')->change();
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');

            $table->unsignedbigInteger('id_diskon')->change();
            $table->foreign('id_diskon')->references('id_diskon')->on('diskons')->onDelete('cascade');
        });

        Schema::table('penjuals', function (Blueprint $table) {
            $table->unsignedbigInteger('id_user')->change();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });

        Schema::table('keranjangs', function (Blueprint $table) {
            $table->unsignedbigInteger('id_user')->change();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');

            $table->unsignedbigInteger('id_produk')->change();
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
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
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_penjual']);
            $table->dropForeign(['id_alamat']);
            $table->dropForeign(['id_metode']);
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

        Schema::table('diskons', function (Blueprint $table) {
            $table->dropForeign(['id_penjual']);
        });

        Schema::table('alamats', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });

        Schema::table('produk_diskons', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
            $table->dropForeign(['id_diskon']);
        });

        Schema::table('penjuals', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });

        Schema::table('keranjangs', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_produk']);
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};
