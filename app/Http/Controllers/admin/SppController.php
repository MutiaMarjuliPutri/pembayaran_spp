<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spp;

class SppController extends Controller
{
    public function index()
    {
        $spp = Spp::all();
        return view('admin.spp.index', compact('spp'));
    }

    public function create()
    {
        return view('admin.spp.tambah_data');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|digits:4',
            'nominal' => 'required|numeric|min:0'
        ]);

        Spp::create([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal
        ]);

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil ditambahkan.');
    }

    public function edit(Spp $spp)
    {
        return view('admin.spp.edit_data', compact('spp'));
    }

    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'tahun' => 'required|digits:4',
            'nominal' => 'required|numeric|min:0'
        ]);

        $spp->update([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal
        ]);

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil diupdate.');
    }

    public function destroy(Spp $spp)
    {
        $spp->delete();
        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil dihapus.');
    }
}


