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
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="">-- Semua Status --</option>
                <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="belum_bayar" {{ request('status') == 'belum_bayar' ? 'selected' : '' }}>Belum Lunas</option>
            </select>
        </div>

        <div class="col-md-2">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" value="{{ request('tahun') }}">
        </div>

        <div class="col-md-3 d-flex align-items-end">
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
                <th>Tahun</th>
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
                    <td>{{ $item->tahun }}</td>
                    <td>Rp {{ number_format($item->spp->nominal, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $item->status == 'Lunas' ? 'success' : 'warning' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Tidak ada data tagihan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
