<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class SiswaAuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('siswa.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required'
        ]);

        $siswa = DB::table('mutia_siswa')->where('nisn', $request->nisn)->first();

        if (!$siswa) {
            return back()->withErrors(['NISN tidak ditemukan.']);
        }

        // Simpan ke session
        Session::put('siswa_id', $siswa->id);
        Session::put('siswa_nama', $siswa->nama);

        return redirect()->route('siswa.tagihan');
    }

    // Menampilkan halaman tagihan siswa
    public function tagihan()
{
    if (!Session::has('siswa_id')) {
        return redirect()->route('siswa.login.form')->with('error', 'Silakan login dulu.');
    }

    $siswaId = Session::get('siswa_id');
    $siswa = DB::table('mutia_siswa')->where('id', $siswaId)->first();

    $tagihans = DB::table('mutia_tagihan_spp')
        ->join('mutia_spp', 'mutia_tagihan_spp.spp_id', '=', 'mutia_spp.id')
        ->leftJoin('mutia_pembayaran', 'mutia_pembayaran.tagihan_id', '=', 'mutia_tagihan_spp.id')
        ->where('mutia_tagihan_spp.siswa_id', $siswaId)
        ->select(
            'mutia_tagihan_spp.*',
            'mutia_spp.nominal',
            'mutia_pembayaran.status'
        )
        ->get();

    return view('siswa.tagihan', compact('siswa', 'tagihans'));
}


    // Logout siswa
    public function logout()
    {
        Session::forget(['siswa_id', 'siswa_nama']);
        return redirect()->route('siswa.login.form');
    }

   public function showBayarForm($id)
{
    $siswaId = Session::get('siswa_id');

    $tagihan = DB::table('mutia_tagihan_spp')
        ->join('mutia_spp', 'mutia_tagihan_spp.spp_id', '=', 'mutia_spp.id')
        ->where('mutia_tagihan_spp.id', $id)
        ->where('mutia_tagihan_spp.siswa_id', $siswaId)
        ->select('mutia_tagihan_spp.*', 'mutia_spp.nominal')
        ->first();

    return view('siswa.form_bayar', compact('tagihan'));
}

public function prosesBayar(Request $request, $id)
{
    $siswaId = Session::get('siswa_id');

    // Ambil nominal dari tagihan via relasi ke tabel mutia_spp
    $tagihan = DB::table('mutia_tagihan_spp')
        ->join('mutia_spp', 'mutia_tagihan_spp.spp_id', '=', 'mutia_spp.id')
        ->where('mutia_tagihan_spp.id', $id)
        ->select('mutia_spp.nominal')
        ->first();

    // Simpan ke tabel pembayaran
    DB::table('mutia_pembayaran')->insert([
        'tagihan_id'    => $id,
        'siswa_id'      => $siswaId,
        'status'        => 'diterima',
        'tanggal_bayar' => now(),
        'jumlah_bayar'  => $tagihan->nominal, // ✅ penting!
        'created_at'    => now(),
        'updated_at'    => now(),
    ]);

    return redirect()->route('siswa.tagihan')->with('success', 'Pembayaran berhasil.');
}



}
