<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'mutia_siswa';

    protected $fillable = [
    'nisn',
    'nama',
    'status',
    'kelas',
    'jurusan',
    'tahun_masuk',
];

}



