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
    Schema::create('mutia_siswa', function (Blueprint $table) {
        $table->id();
        $table->string('nisn')->unique();
        $table->string('nama');
        $table->string('kelas');
        $table->year('tahun_masuk');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutia_siswa');
    }
};
