<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TagihanSpp;
use App\Models\Siswa;
use App\Models\Spp;

class TagihanSppController extends Controller
{
    public function index()
    {
        $tagihan = TagihanSpp::with(['siswa', 'spp'])->get();
        return view('admin.tagihan.index', compact('tagihan'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $spp = Spp::all();
        return view('admin.tagihan.tambah_data', compact('siswa', 'spp'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:mutia_siswa,id',
            'spp_id' => 'required|exists:mutia_spp,id',
            'bulan' => 'required',
            'tahun' => 'required|digits:4',
        ]);

        $spp = Spp::findOrFail($request->spp_id);

        TagihanSpp::create([
            'siswa_id' => $request->siswa_id,
            'spp_id' => $request->spp_id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'jumlah' => $spp->nominal,
            'status' => 'belum_lunas',
        ]);

        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan SPP berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tagihan = TagihanSpp::findOrFail($id);
        $siswa = Siswa::all();
        $spp = Spp::all();
        return view('admin.tagihan.edit_data', compact('tagihan', 'siswa', 'spp'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:belum_lunas,menunggu,diterima,ditolak,lunas',
        ]);

        $tagihan = TagihanSpp::findOrFail($id);

        $tagihan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tagihan.index')->with('success', 'Status tagihan berhasil diupdate.');
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak'
        ]);

        $tagihan = TagihanSpp::findOrFail($id);

        if ($request->status === 'diterima') {
            $tagihan->update([
                'status' => 'lunas'
            ]);
        } else {
            $tagihan->update([
                'status' => 'ditolak'
            ]);
        }

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function getBuktiUrlAttribute()
{
    return $this->bukti_bayar ? asset('storage/bukti_pembayaran/' . $this->bukti_bayar) : null;
}

    
}
