<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mutia_tagihan_spp', function (Blueprint $table) {
            $table->string('metode')->nullable()->after('jumlah');
            $table->string('bukti_bayar')->nullable()->after('metode');
        });
    }

    public function down()
    {
        Schema::table('mutia_tagihan_spp', function (Blueprint $table) {
            $table->dropColumn('metode');
            $table->dropColumn('bukti_bayar');
        });
    }
};
