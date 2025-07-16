<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;

    protected $table = 'mutia_spp';

    protected $fillable = [
        'tahun',
        'nominal',
    ];

    public function tagihan()
    {
        return $this->hasMany(TagihanSpp::class, 'spp_id');
    }
}
