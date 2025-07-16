<?php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TagihanSpp;
use Illuminate\Support\Facades\Auth;
use PDF;

class TagihanController extends Controller
{
    public function index()
{
    $nisn = Auth::user()->nisn;

    $tagihan = TagihanSpp::whereHas('siswa', function($q) use ($nisn) {
        $q->where('nisn', $nisn);
    })
    ->whereIn('status', ['belum_lunas', 'ditolak']) // ✅ tampilkan belum lunas dan ditolak
    ->orderBy('tahun', 'asc')
    ->orderByRaw("FIELD(bulan, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')")
    ->get();

    return view('siswa.tagihan.index', compact('tagihan'));
}

  

    public function bayar($id)
    {
        $tagihan = TagihanSpp::findOrFail($id);

        // Pastikan tagihan milik siswa yang login
        if ($tagihan->siswa->nisn != auth()->user()->nisn) {
            abort(403, 'Unauthorized');
        }

        $tagihan->update(['status' => 'lunas']);

        return redirect()->route('siswa.tagihan')->with('success', 'Pembayaran berhasil!');
    }

    public function showBayar($id)
{
    $tagihan = TagihanSpp::findOrFail($id);

    if ($tagihan->siswa->nisn != auth()->user()->nisn) {
        abort(403, 'Unauthorized');
    }

    return view('siswa.pembayaran.index', compact('tagihan'));
}

public function prosesBayar(Request $request, $id)
{
    $request->validate([
        'metode' => 'required|in:Transfer,E-Wallet,Tunai',
        'bukti_bayar' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $tagihan = TagihanSpp::findOrFail($id);

    // Upload file
    $file = $request->file('bukti_bayar');
    $filename = time().'_'.$file->getClientOriginalName();
    $file->move(public_path('storage/bukti_pembayaran'), $filename);

    // Update tagihan
    $tagihan->update([
        'status' => 'menunggu',
        'metode' => $request->metode,
        'bukti_bayar' => $filename,
    ]);

    return redirect()->route('siswa.tagihan')->with('success', 'Bukti pembayaran berhasil dikirim, menunggu verifikasi admin.');
}

public function cetakNota($id)
{
    $tagihan = TagihanSpp::findOrFail($id);

    if ($tagihan->status != 'diterima') {
        return back()->with('error', 'Nota hanya bisa dicetak jika pembayaran sudah diterima.');
    }

    $pdf = PDF::loadView('siswa.pembayaran.nota', compact('tagihan'));
    return $pdf->download('nota_pembayaran_'.$tagihan->id.'.pdf');
}

}
