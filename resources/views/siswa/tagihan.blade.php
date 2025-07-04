@extends('template')

@section('content')
<div class="container mt-5">
    <h3>Selamat Datang, {{ $siswa->nama }}</h3>

    {{-- Tombol Logout --}}
    <form method="POST" action="{{ route('siswa.logout') }}">
        @csrf
        <button class="btn btn-danger mb-3">Logout</button>
    </form>

    {{-- Tabel Tagihan SPP --}}
    <h4>Tagihan SPP</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Nominal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tagihans as $tagihan)
            <tr>
                <td>{{ $tagihan->bulan }}</td>
                <td>{{ $tagihan->tahun }}</td>
                <td>Rp{{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                <td>
                    @if($tagihan->status == 'diterima')
                        <span class="badge bg-success">Lunas</span>
                    @else
                        <a href="{{ route('siswa.bayar.form', $tagihan->id) }}" class="btn btn-sm btn-primary">Bayar</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
