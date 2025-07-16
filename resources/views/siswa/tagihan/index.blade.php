@extends('layout.siswa_template')

@section('title', 'Tagihan SPP')

@section('content')

<style>
    .tagihan-card {
        background: #fff;
        border-radius: 15px;
        padding: 20px 25px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        transition: all 0.3s ease-in-out;
    }
    .tagihan-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.08);
    }
    .tagihan-status {
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }
    .lunas {
        background: #e9f8ef;
        color: #28a745;
    }
    .belum-lunas {
        background: #fff4f4;
        color: #dc3545;
    }
    .btn-bayar {
        background: linear-gradient(90deg, #2f39f3, #5a6df7);
        color: #fff;
        border-radius: 30px;
        padding: 8px 22px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-bayar:hover {
        background: linear-gradient(90deg, #1c28c0, #4c58e0);
        box-shadow: 0 6px 18px rgba(47,57,243,0.3);
    }
    .tagihan-icon {
        font-size: 32px;
        margin-right: 18px;
        color: #4b5ff1;
    }
</style>

<h4 class="fw-bold mb-4 text-primary"><i class="bi bi-receipt-cutoff me-2"></i> Tagihan SPP</h4>
@if ($tagihan->where('status', 'ditolak')->count() > 0)
        <div class="alert alert-danger shadow-sm">
            <i class="bi bi-x-circle me-1"></i> 
            Ada pembayaran yang <b>ditolak</b>. Silakan upload ulang bukti pembayaran untuk bulan:
            <ul class="mb-0">
                @foreach($tagihan->where('status', 'ditolak') as $data)
                    <li>{{ $data->bulan }} {{ $data->tahun }}</li>
                @endforeach
            </ul>
        </div>
        @endif

@forelse($tagihan as $tgh)
<div class="tagihan-card d-flex justify-content-between align-items-center flex-wrap">

    <div class="d-flex align-items-center">
        <i class="bi bi-wallet2 tagihan-icon"></i>
        <div>
            <h5 class="fw-bold mb-1">{{ $tgh->bulan }} {{ $tgh->tahun }}</h5>
            <div class="text-muted small">Jumlah Tagihan:</div>
            <div class="fs-5 fw-semibold text-dark">Rp {{ number_format($tgh->jumlah,0,',','.') }}</div>
        </div>
    </div>

    <div class="text-end mt-3 mt-md-0">
        @if($tgh->status == 'lunas')
            <span class="tagihan-status lunas"><i class="bi bi-check-circle-fill me-1"></i> Lunas</span>
        @else
            <span class="tagihan-status belum-lunas"><i class="bi bi-exclamation-circle-fill me-1"></i> Belum Lunas</span><br>
            <a href="{{ route('siswa.bayar', $tgh->id) }}" class="btn-bayar mt-2"><i class="bi bi-cash-stack me-1"></i> Bayar Sekarang</a>
        @endif
    </div>

</div>
@empty
    <div class="alert alert-info text-center shadow-sm"><i class="bi bi-info-circle me-1"></i> Belum ada tagihan yang harus dibayar.</div>
@endforelse

@endsection
