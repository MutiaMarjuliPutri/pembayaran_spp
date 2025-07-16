<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PengaturanController extends Controller
{
    public function index()
{
    $users = User::all();
    return view('admin.pengaturan.index', compact('users'));
}

public function destroy($id)
{
    $user = User::findOrFail($id);

    // Cegah admin menghapus dirinya sendiri (opsional)
    if (Auth::id() == $id) {
        return back()->with('error', 'Tidak bisa menghapus akun sendiri!');
    }

    $user->delete();

    return back()->with('success', 'Akun berhasil dihapus.');
}
}
