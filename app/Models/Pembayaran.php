<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'mutia_pembayaran';

    protected $fillable = ['tagihan_id', 'tanggal_bayar', 'jumlah_bayar', 'bukti_bayar', 'status'];

    public function tagihan()
    {
        return $this->belongsTo(TagihanSpp::class, 'tagihan_id');
    }
}
