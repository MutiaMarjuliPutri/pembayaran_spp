<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TagihanSpp;
use App\Models\Siswa;
use App\Models\Spp;

class TagihanSppController extends Controller
{
    // TAMPILKAN SEMUA TAGIHAN
    public function index()
    {
        $tagihan = TagihanSpp::with(['siswa', 'spp'])->get();
        return view('tagihan.index', compact('tagihan'));
    }

    // TAMPILKAN FORM TAMBAH TAGIHAN
    public function create()
    {
        $siswa = Siswa::all();
        $spp = Spp::all();
        return view('tagihan.create', compact('siswa', 'spp'));
    }

    // SIMPAN DATA TAGIHAN BARU
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:mutia_siswa,id',
            'spp_id' => 'required|exists:mutia_spp,id',
            'bulan' => 'required',
            'tahun' => 'required|digits:4',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        TagihanSpp::create($request->all());

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan');
    }

    // TAMPILKAN FORM EDIT TAGIHAN
    public function edit($id)
    {
        $tagihan = TagihanSpp::findOrFail($id);
        $siswa = Siswa::all();
        $spp = Spp::all();

        return view('tagihan.edit', compact('tagihan', 'siswa', 'spp'));
    }

    // UPDATE DATA TAGIHAN
    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:mutia_siswa,id',
            'spp_id' => 'required|exists:mutia_spp,id',
            'bulan' => 'required',
            'tahun' => 'required|digits:4',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $tagihan = TagihanSpp::findOrFail($id);
        $tagihan->update($request->all());

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil diperbarui');
    }

    // HAPUS DATA TAGIHAN
    public function destroy($id)
    {
        $tagihan = TagihanSpp::findOrFail($id);
        $tagihan->delete();

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dihapus');
    }
    public function bayar($id)
{
    $tagihan = TagihanSpp::findOrFail($id);
    $tagihan->status = 'Lunas';
    $tagihan->save();

    return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dibayar');
}
public function laporan(Request $request)
{
    $siswa = Siswa::all();
    $query = TagihanSpp::with(['siswa', 'spp']);

    if ($request->filled('siswa_id')) {
        $query->where('siswa_id', $request->siswa_id);
    }
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    if ($request->filled('tahun')) {
        $query->where('tahun', $request->tahun);
    }

    $tagihan = $query->get();

    return view('tagihan.laporan', compact('tagihan', 'siswa'));
}

}
