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
    Schema::table('mutia_pembayaran', function (Blueprint $table) {
        $table->unsignedBigInteger('siswa_id')->after('id');
    });
}

public function down()
{
    Schema::table('mutia_pembayaran', function (Blueprint $table) {
        $table->dropColumn('siswa_id');
    });
}


    /**
     * Reverse the migrations.
     */
    
};
