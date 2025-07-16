<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TagihanSpp;

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil semua tagihan yang statusnya lunas
        $laporan = TagihanSpp::with('siswa', 'spp')
                    ->where('status', 'lunas')
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return view('admin.laporan.index', compact('laporan'));
    }
}


