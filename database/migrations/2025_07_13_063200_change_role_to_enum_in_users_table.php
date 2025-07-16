<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Ubah kolom role menjadi ENUM
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'siswa') NOT NULL");
    }

    public function down()
    {
        // Kembalikan ke varchar jika di-rollback
        DB::statement("ALTER TABLE users MODIFY role VARCHAR(255) NOT NULL");
    }
};
