@extends('template')

@section('content')
<div class="container">
    <h2>Data Tagihan SPP</h2>
    <a href="{{ route('tagihan.create') }}" class="btn btn-primary mb-3">+ Tambah Tagihan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($tagihan as $kelas => $daftarTagihan)
        <h4 class="mt-4">Kelas: {{ $kelas }}</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($daftarTagihan as $item)
                    <tr>
                        <td>{{ $item->siswa->nama }}</td>
                        <td>{{ $item->bulan }}</td>
                        <td>{{ $item->spp->tahun }}</td>
                        <td>Rp {{ number_format($item->spp->nominal, 0, ',', '.') }}</td>
                        <td>
                            @if($item->pembayaran && $item->pembayaran->status === 'diterima')
                                <span class="badge bg-success">Lunas</span>
                            @else
                                <span class="badge bg-warning">Belum Lunas</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tagihan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('tagihan.destroy', $item->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @empty
        <p class="text-center">Belum ada data tagihan</p>
    @endforelse
</div>
@endsection
