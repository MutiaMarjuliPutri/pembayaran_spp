@extends('layout.admin_template')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container my-4">
    <div class="card shadow-sm p-4 rounded-4">
        <h4 class="fw-bold mb-3 text-primary"><i class="bi bi-speedometer2"></i> Dashboard</h4>

        <div class="mb-3 text-muted">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y | H:i:s') }} | Selamat {{ \Carbon\Carbon::now()->hour < 18 ? 'sore' : 'malam' }}, ADMIN
        </div>

        <div class="row g-4">

            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 text-center bg-info text-white">
                    <i class="bi bi-bank2 fs-1 mb-2"></i>
                    <div class="fw-bold">NAMA SEKOLAH</div>
                    <div>SMK NEGERI 1 IV KOTO AUR MALINTANG</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 text-center bg-danger text-white">
                    <i class="bi bi-person-badge fs-1 mb-2"></i>
                    <div class="fw-bold">KEPALA SEKOLAH</div>
                    <div>Ir.Arizon, S.Pd, S.Kom,</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 text-center bg-success text-white">
                    <i class="bi bi-people-fill fs-1 mb-2"></i>
                    <div class="fw-bold">SISWA AKTIF</div>
                    <div>{{ $siswaAktif }}</div>
                </div>
            </div>

           <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 text-center bg-warning text-dark">
                    <i class="bi bi-person-badge fs-1 mb-2"></i>
                    <div class="fw-bold">AKUN AKTIF</div>
                    <div>{{ $akunAktif }}</div>
                </div>
            </div>
        </div>

        <div class="alert alert-info mt-4 rounded-4 shadow-sm">
            Ini adalah halaman Dashboard yang digunakan untuk mengelola Pembayaran Sekolah, Tabungan Siswa, dan Hutang Piutang.
            <br>Silakan digunakan dengan baik. Jika ada kendala, silakan sampaikan kepada pengembang aplikasi.
        </div>

    </div>
</div>

@endsection
