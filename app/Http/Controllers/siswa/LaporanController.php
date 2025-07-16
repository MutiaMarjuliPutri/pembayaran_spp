<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TagihanSpp;
use Illuminate\Support\Facades\Auth;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $nisn = Auth::user()->nisn;

        $laporan = TagihanSpp::whereHas('siswa', function($q) use ($nisn) {
            $q->where('nisn', $nisn);
        })->where('status', 'lunas')
          ->orderBy('tahun', 'asc')
          ->orderByRaw("FIELD(bulan, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')")
          ->get();

        return view('siswa.laporan.index', compact('laporan'));
    }

    public function cetakNota($id)
    {
        $tagihan = TagihanSpp::findOrFail($id);

        if ($tagihan->siswa->nisn != auth()->user()->nisn) {
            abort(403, 'Unauthorized');
        }

        return view('siswa.laporan.nota_print', compact('tagihan'));
    }

}

