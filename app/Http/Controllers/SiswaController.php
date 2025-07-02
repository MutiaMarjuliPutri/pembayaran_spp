<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Tampilkan semua siswa
    public function index()
    {
        $siswa = Siswa::all();
        return view('siswa.index', compact('siswa'));
    }

    // Tampilkan form tambah siswa
    public function create()
    {
        return view('siswa.create');
    }

    // Simpan data siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:mutia_siswa',
            'nama' => 'required',
            'kelas' => 'required',
            'tahun_masuk' => 'required|digits:4',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    // Tampilkan detail siswa (opsional)
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    // Tampilkan form edit
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    // Update data siswa
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nisn' => 'required|unique:mutia_siswa,nisn,' . $siswa->id,
            'nama' => 'required',
            'kelas' => 'required',
            'tahun_masuk' => 'required|digits:4',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    // Hapus data siswa
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
