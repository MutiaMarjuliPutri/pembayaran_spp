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
    Schema::create('mutia_pembayaran', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('tagihan_id');     // relasi ke mutia_tagihan_spp
        $table->date('tanggal_bayar');                // tanggal siswa bayar
        $table->bigInteger('jumlah_bayar');           // nominal yang dibayar
        $table->string('bukti_bayar')->nullable();    // path file bukti bayar
        $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
        $table->timestamps();

        // foreign key
        $table->foreign('tagihan_id')->references('id')->on('mutia_tagihan_spp')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutia_pembayaran');
    }
};
