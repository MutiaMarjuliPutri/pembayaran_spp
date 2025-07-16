@extends('layout.admin_template')

@section('title', 'Laporan Tagihan SPP')

@section('content')
<div class="container my-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold text-primary mb-0">📑 Laporan Tagihan SPP</h4>
        <a href="{{ route('admin.tagihan.create') }}" class="btn btn-success shadow-sm rounded-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Tagihan SPP
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tagihan as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="text-start">{{ $data->siswa->nama }}</td>
                            <td>{{ ucfirst($data->bulan) }}</td>
                            <td>{{ $data->tahun }}</td>
                            <td>Rp {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $data->metode ?? '-' }}</td>
                            <td>
                                @if($data->bukti_bayar)
                                    <a href="{{ asset('storage/bukti_pembayaran/'.$data->bukti_bayar) }}" target="_blank" class="btn btn-outline-info btn-sm rounded-3 shadow-sm" title="Lihat Bukti">
                                        <i class="bi bi-file-earmark-image"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge 
                                    @if($data->status == 'lunas') bg-success 
                                    @elseif($data->status == 'menunggu') bg-warning text-dark
                                    @elseif($data->status == 'ditolak') bg-danger 
                                    @else bg-secondary 
                                    @endif rounded-pill px-3 py-2">
                                    {{ ucfirst(str_replace('_', ' ', $data->status)) }}
                                </span>
                            </td>
                            <td>
                                @if($data->status == 'menunggu')
                                    <form action="{{ route('admin.tagihan.verifikasi', $data->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button name="status" value="diterima" class="btn btn-success btn-sm rounded-3 shadow-sm mb-1">
                                            <i class="bi bi-check-circle"></i> Terima
                                        </button>
                                        <button name="status" value="ditolak" class="btn btn-danger btn-sm rounded-3 shadow-sm">
                                            <i class="bi bi-x-circle"></i> Tolak
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.tagihan.edit', $data->id) }}" class="btn btn-warning btn-sm rounded-3 shadow-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Belum ada data tagihan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
