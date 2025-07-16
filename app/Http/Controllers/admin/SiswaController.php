<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.tambah_data');
    }

    public function store(Request $request)
{
    $request->validate([
        'nisn' => 'required|unique:mutia_siswa,nisn',
        'nama' => 'required',
        'kelas' => 'required',
        'jurusan' => 'required', // Validasi jurusan
    ]);

    $siswa = Siswa::create([
        'nisn' => $request->nisn,
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'jurusan' => $request->jurusan, // Simpan jurusan
        'tahun_masuk' => now()->year
    ]);

    User::create([
        'name' => $request->nama,
        'email' => $request->nisn . '_' . uniqid() . '@siswa.local',
        'nisn' => $request->nisn,
        'password' => \Hash::make('12345678'),
        'role' => 'siswa',
        'siswa_id' => $siswa->id,
    ]);

    return redirect()->route('siswa.index')->with('success', 'Data siswa dan akun login berhasil dibuat.');
}



    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit_data', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
{
    $request->validate([
        'nisn' => 'required|unique:mutia_siswa,nisn,' . $siswa->id,
        'nama' => 'required',
        'kelas' => 'required',
        'jurusan' => 'required', // Validasi jurusan
    ]);

    $siswa->update([
        'nisn' => $request->nisn,
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'jurusan' => $request->jurusan,
    ]);

    return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate.');
}


    public function destroy(Siswa $siswa)
    {
        // Hapus user terkait jika ada
        User::where('siswa_id', $siswa->id)->delete();

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa dan akun login berhasil dihapus.');
    }
}
