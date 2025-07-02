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
    Schema::create('mutia_spp', function (Blueprint $table) {
        $table->id();
        $table->year('tahun');             // Tahun ajaran, contoh: 2023
        $table->bigInteger('nominal');     // Tarif per bulan, contoh: 200000
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutia_spp');
    }
};
