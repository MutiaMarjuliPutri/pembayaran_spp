@extends('template')

@section('content')
<div class="container mt-5">
    <h4>Konfirmasi Pembayaran</h4>

    <p><strong>Bulan:</strong> {{ $tagihan->bulan }}</p>
    <p><strong>Tahun:</strong> {{ $tagihan->tahun }}</p>
    <p><strong>Nominal:</strong> Rp{{ number_format($tagihan->nominal, 0, ',', '.') }}</p>

    <form method="POST" action="{{ route('siswa.bayar', $tagihan->id) }}">
        @csrf
        <button class="btn btn-success">Konfirmasi Bayar</button>
        <a href="{{ route('siswa.tagihan') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
