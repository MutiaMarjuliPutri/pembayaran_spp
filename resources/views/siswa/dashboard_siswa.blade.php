@extends('layout.siswa_template')

@section('title', 'Dashboard Siswa')

@section('content')

<style>
    .welcome-section {
        text-align: center;
        margin-top: 30px;
    }
    .background-banner {
        width: 100%;
        height: 320px;
        background: url('{{ asset('gambar/back.jpg') }}') center center / cover no-repeat;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .feature-box {
        text-align: center;
        padding: 25px 20px;
        transition: 0.3s;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        height: 100%;
    }
    .feature-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .feature-box img {
        width: 55px;
        margin-bottom: 15px;
    }
    .menu-list .list-group-item {
        transition: 0.3s;
        border: none;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 10px;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .menu-list .list-group-item:hover {
        background: linear-gradient(90deg, #2f39f3, #5f6af7);
        color: #fff !important;
        transform: translateY(-2px);
    }
    .menu-list .list-group-item a {
        color: inherit;
        text-decoration: none;
        display: block;
        width: 100%;
    }
</style>

<div class="container">
    
    
    <div class="welcome-section">

        {{-- Banner --}}
        <div class="background-banner mb-4"></div>

        {{-- Salam --}}
        <h4 class="fw-bold text-primary">Selamat Datang, {{ Auth::user()->name }}</h4>
        <p class="text-muted">Kelola pembayaran SPP dengan mudah dan aman melalui SMKKPAY</p>

        {{-- Fitur --}}
        <div class="row mt-5 g-4">
            <div class="col-md-3">
                <div class="feature-box">
                    <img src="{{ asset('gambar/finance.png') }}" alt="Laporan Keuangan">
                    <h6 class="fw-bold text-success mt-2">Laporan Keuangan</h6>
                    <p class="text-muted small">Pantau semua pembayaran SPP secara real-time dan akurat.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box">
                    <img src="{{ asset('gambar/payment.png') }}" alt="Metode Pembayaran">
                    <h6 class="fw-bold text-success mt-2">Metode Pembayaran</h6>
                    <p class="text-muted small">Bayar SPP lewat bank, e-wallet, atau transfer langsung.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box">
                    <img src="{{ asset('gambar/clock.png') }}" alt="Tersedia 24/7">
                    <h6 class="fw-bold text-success mt-2">Akses 24/7</h6>
                    <p class="text-muted small">Kelola tagihan dan pembayaran kapan saja, tanpa batas waktu.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box">
                    <img src="{{ asset('gambar/notification.png') }}" alt="Pengingat Tagihan">
                    <h6 class="fw-bold text-success mt-2">Pengingat Tagihan</h6>
                    <p class="text-muted small">Notifikasi otomatis saat tagihan mendekati jatuh tempo.</p>
                </div>
            </div>
        </div>

        {{-- Ilustrasi --}}
        <div class="mt-5 text-center">
            <img src="{{ asset('gambar/ilustrasi.png') }}" alt="Ilustrasi" class="img-fluid" style="max-width: 450px;">
            <h5 class="mt-3 fw-bold text-primary">Pembayaran Mudah & Transparan</h5>
            <p class="text-muted small">Semua proses pembayaran kini bisa dilakukan dari rumah dengan SMKKPAY.</p>
        </div>

        {{-- Menu Siswa --}}
        <div class="mt-4">
            <h6 class="fw-bold text-secondary mb-3">Akses Cepat</h6>
            <ul class="list-group menu-list">
                <li class="list-group-item">
                    <a href="{{ route('siswa.tagihan') }}"><i class="bi bi-receipt-cutoff me-2"></i> Lihat Tagihan SPP</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('siswa.tagihan') }}"><i class="bi bi-wallet2 me-2"></i> Bayar SPP</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('siswa.laporan') }}"><i class="bi bi-clock-history me-2"></i> Riwayat Pembayaran</a>
                </li>
            </ul>
        </div>

    </div>

</div>

@endsection
