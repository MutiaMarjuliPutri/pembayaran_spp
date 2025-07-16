@extends('layout.siswa_template')

@section('title', 'Pembayaran SPP')

@section('content')

<style>
    .payment-card {
        background: #fff;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        transition: all 0.3s ease-in-out;
    }
    .payment-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    }
    .payment-label {
        font-weight: 600;
        color: #555;
        font-size: 0.95rem;
    }
    .payment-value {
        font-size: 1.4rem;
        font-weight: bold;
        color: #2c3e50;
    }
    .btn-pay {
        background: linear-gradient(90deg, #2f39f3, #5a6dfc);
        color: #fff;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: bold;
        transition: 0.3s ease;
    }
    .btn-pay:hover {
        background: linear-gradient(90deg, #1d28d0, #4e5cf4);
        box-shadow: 0 5px 15px rgba(47,57,243,0.4);
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(47,57,243,0.2);
    }
</style>

<div class="container my-5">
    <h3 class="fw-bold mb-4 text-primary"><i class="bi bi-credit-card me-2"></i> Pembayaran SPP</h3>

    <div class="payment-card mx-auto" style="max-width: 500px;">
        <div class="mb-4">
            <label class="payment-label">Bulan Tagihan:</label>
            <div class="payment-value">{{ $tagihan->bulan }} {{ $tagihan->tahun }}</div>
        </div>

        <div class="mb-4">
            <label class="payment-label">Jumlah yang Harus Dibayar:</label>
            <div class="payment-value">Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</div>
        </div>

        <form action="{{ route('siswa.prosesBayar', $tagihan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="payment-label">Pilih Metode Pembayaran</label>
                <select name="metode" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Metode --</option>
                    <option value="Transfer">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet</option>
                    
                </select>
            </div>

            <div class="mb-4">
                <label class="payment-label">Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_bayar" class="form-control" accept="image/*,application/pdf" required>
                <small class="text-muted">File berupa JPG, PNG, atau PDF (maksimal 2MB)</small>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('siswa.tagihan') }}" class="btn btn-secondary rounded-pill px-4">Kembali</a>
                <button type="submit" class="btn btn-pay">Kirim Pembayaran</button>
            </div>
        </form>
    </div>
</div>

@endsection
