@extends('template')

@section('content')

<div class="container mt-5"> <div class="d-flex justify-content-between align-items-center mb-3"> <h3>Selamat Datang, {{ $siswa->nama }}</h3> <form method="POST" action="{{ route('siswa.logout') }}"> @csrf <button class="btn btn-danger">Logout</button> </form> </div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tagihan SPP</h5>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tagihans as $tagihan)
                    <tr class="text-center">
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
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Tidak ada tagihan aktif</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
 @endsection