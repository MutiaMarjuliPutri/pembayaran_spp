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
    $kelasList = Siswa::select('kelas')->distinct()->pluck('kelas');
    $spp = Spp::all();
    return view('tagihan.create', compact('kelasList', 'spp'));
}


    // SIMPAN DATA TAGIHAN BARU
   public function store(Request $request)
{
    $request->validate([
        'kelas' => 'required',
        'spp_id' => 'required|exists:mutia_spp,id',
        'bulan' => 'required',
        'status' => 'required|in:lunas,belum_bayar',
    ]);

    $siswaList = Siswa::where('kelas', $request->kelas)->get();

    $jumlah = 0;
    foreach ($siswaList as $siswa) {
        // Cek jika tagihan untuk siswa tersebut di bulan dan tahun yg sama sudah ada
        $cek = TagihanSpp::where([
            'siswa_id' => $siswa->id,
            'bulan' => $request->bulan,
          
        ])->first();

        if (!$cek) {
            TagihanSpp::create([
                'siswa_id' => $siswa->id,
                'spp_id' => $request->spp_id,
                'bulan' => $request->bulan,
            
                'status' => $request->status,
            ]);
            $jumlah++;
        }
    }

    return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dibuat untuk ' . $jumlah . ' siswa di kelas ' . $request->kelas);
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
           
            'status' => 'required|in:lunas,belum_bayar',
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
    $tagihan->status = 'lunas';
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
   

    $tagihan = $query->get();

    return view('tagihan.laporan', compact('tagihan', 'siswa'));
}

}
