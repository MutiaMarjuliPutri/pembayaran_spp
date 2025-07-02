<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'mutia_siswa';

    protected $fillable = ['nisn', 'nama', 'kelas', 'tahun_masuk'];

    public function tagihanSpp()
    {
        return $this->hasMany(TagihanSpp::class, 'siswa_id');
    }
}
