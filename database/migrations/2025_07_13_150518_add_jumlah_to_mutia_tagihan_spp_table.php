<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('mutia_tagihan_spp', function (Blueprint $table) {
            $table->bigInteger('jumlah')->after('tahun');
        });
    }

    public function down(): void
    {
        Schema::table('mutia_tagihan_spp', function (Blueprint $table) {
            $table->dropColumn('jumlah');
        });
    }
};

