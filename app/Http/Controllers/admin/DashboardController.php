<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $siswaAktif = Siswa::where('status', 'aktif')->count();
        $akunAktif = User::where('status', 'aktif')->count();

        return view('admin.dashboard_admin', [
            'siswaAktif' => $siswaAktif,
            'akunAktif' => $akunAktif,
            'saldoTabungan' => 100000,
            'hutangPiutang' => 25000
        ]);
    }
}
