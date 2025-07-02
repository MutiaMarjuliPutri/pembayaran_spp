<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    // Menampilkan semua data SPP
    public function index()
    {
        $spp = Spp::all();
        return view('spp.index', compact('spp'));
    }

    // Tampilkan form tambah SPP
    public function create()
    {
        return view('spp.create');
    }

    // Simpan data SPP baru
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|digits:4|unique:mutia_spp,tahun',
            'nominal' => 'required|numeric|min:10000',
        ]);

        Spp::create($request->all());

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil ditambahkan');
    }

    // Menampilkan form edit SPP
    public function edit(Spp $spp)
    {
        return view('spp.edit', compact('spp'));
    }

    // Update data SPP
    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'tahun' => 'required|digits:4|unique:mutia_spp,tahun,' . $spp->id,
            'nominal' => 'required|numeric|min:10000',
        ]);

        $spp->update($request->all());

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil diperbarui');
    }

    // Hapus data SPP
    public function destroy(Spp $spp)
    {
        $spp->delete();
        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil dihapus');
    }
}
