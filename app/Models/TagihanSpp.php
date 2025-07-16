<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Spp;

class TagihanSpp extends Model
{
    protected $table = 'mutia_tagihan_spp';

    protected $fillable = [
        'siswa_id',
        'spp_id',
        'bulan',
        'tahun',
        'jumlah',
        'status',
        'metode',        // tambahkan metode pembayaran
        'bukti_bayar'    // tambahkan bukti pembayaran
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 'spp_id');
    }
}
