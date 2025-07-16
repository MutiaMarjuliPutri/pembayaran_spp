@extends('layout.admin_template')

@section('title', 'Laporan Pembayaran')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h4 class="fw-semibold mb-4">📊 Laporan Pembayaran SPP</h4>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Waktu Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="text-start">{{ $data->siswa->nama }}</td>
                            <td>{{ $data->siswa->kelas }}</td>
                            <td>{{ ucfirst($data->bulan) }}</td>
                            <td>{{ $data->tahun }}</td>
                            <td>Rp {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge 
                                    @if(strtolower($data->status) == 'lunas') bg-success 
                                    @elseif(strtolower($data->status) == 'menunggu') bg-warning text-dark
                                    @elseif(strtolower($data->status) == 'ditolak') bg-danger 
                                    @else bg-secondary 
                                    @endif rounded-pill px-3 py-2">
                                    {{ ucfirst($data->status) }}
                                </span>
                            </td>
                            <td>{{ $data->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data pembayaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
