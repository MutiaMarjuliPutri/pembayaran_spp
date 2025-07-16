@extends('layout.siswa_template')

@section('title', 'Riwayat Pembayaran')

@section('content')

<style>
    .table-premium {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }
    .table-premium th {
        background: linear-gradient(90deg, #2f39f3, #5a6df7);
        color: #fff;
        text-align: center;
    }
    .table-premium td {
        vertical-align: middle;
        text-align: center;
    }
    .badge-lunas {
        background: #d4edda;
        color: #155724;
        padding: 6px 15px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>

<div class="container my-4">
    <h4 class="fw-bold mb-4 text-primary"><i class="bi bi-wallet2 me-2"></i> Riwayat Pembayaran SPP</h4>

    @if($laporan->isEmpty())
        <div class="alert alert-info shadow-sm text-center">
            <i class="bi bi-info-circle me-1"></i> Belum ada pembayaran yang tercatat.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-premium">
                <thead>
    <tr>
        <th>No</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Aksi</th> <!-- Tambahkan kolom aksi -->
    </tr>
</thead>
<tbody>
    @foreach($laporan as $key => $data)
<tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $data->bulan }}</td>
    <td>{{ $data->tahun }}</td>
    <td>Rp {{ number_format($data->jumlah, 0, ',', '.') }}</td>
    <td><span class="badge-lunas"><i class="bi bi-check-circle-fill me-1"></i> Lunas</span></td>
    <td>
        <a href="{{ route('siswa.laporan.cetak', $data->id) }}" target="_blank" class="btn btn-sm btn-outline-primary shadow-sm">
            <i class="bi bi-printer"></i> Cetak Nota
        </a>
    </td>
</tr>
@endforeach

</tbody>

            </table>
        </div>
    @endif
</div>

@endsection
