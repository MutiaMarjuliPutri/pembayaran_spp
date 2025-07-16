<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProfilController extends Controller
{
    public function index()
    {
        $nisn = Auth::user()->nisn;

        $siswa = \App\Models\Siswa::where('nisn', $nisn)->firstOrFail();

        return view('siswa.profil.index', compact('siswa'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('siswa.profil.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6|confirmed',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    // Ganti password jika diisi
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    // Upload Foto
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($user->foto && file_exists(public_path('uploads/gambar/' . $user->foto))) {
            unlink(public_path('uploads/gambar/' . $user->foto));
        }

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/gambar'), $filename);

        $user->foto = $filename;
    }

    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}

}

