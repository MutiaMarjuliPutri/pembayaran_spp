<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1️⃣ Tambahkan enum baru sementara (supaya 'belum_lunas' valid)
        Schema::table('mutia_tagihan_spp', function (Blueprint $table) {
            DB::statement("ALTER TABLE mutia_tagihan_spp MODIFY COLUMN status ENUM('belum_bayar', 'belum_lunas', 'menunggu', 'diterima', 'ditolak', 'lunas') NOT NULL DEFAULT 'belum_bayar'");
        });

        // 2️⃣ Update data lama ke format baru
        DB::table('mutia_tagihan_spp')->where('status', 'belum_bayar')->update(['status' => 'belum_lunas']);

        // 3️⃣ Set ENUM final (hapus enum 'belum_bayar')
        Schema::table('mutia_tagihan_spp', function (Blueprint $table) {
            DB::statement("ALTER TABLE mutia_tagihan_spp MODIFY COLUMN status ENUM('belum_lunas', 'menunggu', 'diterima', 'ditolak', 'lunas') NOT NULL DEFAULT 'belum_lunas'");
        });
    }

    public function down()
    {
        // Balikan ke status lama
        Schema::table('mutia_tagihan_spp', function (Blueprint $table) {
            DB::statement("ALTER TABLE mutia_tagihan_spp MODIFY COLUMN status ENUM('belum_bayar', 'belum_lunas', 'menunggu', 'diterima', 'ditolak', 'lunas') NOT NULL DEFAULT 'belum_lunas'");
        });

        DB::table('mutia_tagihan_spp')->where('status', 'belum_lunas')->update(['status' => 'belum_bayar']);
        DB::table('mutia_tagihan_spp')->whereIn('status', ['menunggu', 'diterima', 'ditolak'])->update(['status' => 'belum_bayar']);

        Schema::table('mutia_tagihan_spp', function (Blueprint $table) {
            DB::statement("ALTER TABLE mutia_tagihan_spp MODIFY COLUMN status ENUM('belum_bayar', 'lunas') NOT NULL DEFAULT 'belum_bayar'");
        });
    }
};
