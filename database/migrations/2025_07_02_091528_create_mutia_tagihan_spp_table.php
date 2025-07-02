<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('mutia_tagihan_spp', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('siswa_id');
        $table->unsignedBigInteger('spp_id');
        $table->enum('bulan', [
            'Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        ]);
        $table->year('tahun');
        $table->enum('status', ['belum_bayar', 'lunas'])->default('belum_bayar');
        $table->timestamps();

        // Relasi (opsional kalau pakai foreign key)
        $table->foreign('siswa_id')->references('id')->on('mutia_siswa')->onDelete('cascade');
        $table->foreign('spp_id')->references('id')->on('mutia_spp')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutia_tagihan_spp');
    }
};
