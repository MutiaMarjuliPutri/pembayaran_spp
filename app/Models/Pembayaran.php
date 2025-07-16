<?php
class Pembayaran extends Model
{
    protected $table = 'mutia_pembayaran';

    protected $fillable = [
        'siswa_id',
        'tagihan_id',
        'tanggal_bayar',
        'jumlah_bayar',
        'metode',
        'status',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function tagihan()
    {
        return $this->belongsTo(TagihanSpp::class, 'tagihan_id');
    }
}

