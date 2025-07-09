@extends('template')

@section('content')
<div class="container">
    <h2>Laporan Pembayaran SPP</h2>

    <form method="GET" action="{{ route('tagihan.laporan') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label>Nama Siswa</label>
            <select name="siswa_id" class="form-control">
                <option value="">-- Semua Siswa --</option>
                @foreach ($siswa as $s)
                    <option value="{{ $s->id }}" {{ request('siswa_id') == $s->id ? 'selected' : '' }}>
                        {{ $s->nama }} - {{ $s->kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" placeholder="Contoh: 10 atau 11" value="{{ request('kelas') }}">
        </div>

        <div class="col-md-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="">-- Semua Status --</option>
                <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="belum_bayar" {{ request('status') == 'belum_bayar' ? 'selected' : '' }}>Belum Lunas</option>
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
            <a href="{{ route('tagihan.laporan') }}" class="btn btn-secondary ms-2">Reset</a>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Bulan</th>
                <th>Nominal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tagihan as $item)
                <tr>
                    <td>{{ $item->siswa->nama }}</td>
                    <td>{{ $item->siswa->kelas }}</td>
                    <td>{{ $item->bulan }}</td>
                    <td>Rp {{ number_format($item->spp->nominal, 0, ',', '.') }}</td>
                    <td>
                        @if($item->pembayaran && $item->pembayaran->status === 'diterima')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-warning">Belum Lunas</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Tidak ada data tagihan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
