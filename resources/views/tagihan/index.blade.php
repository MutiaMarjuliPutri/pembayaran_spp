@extends('template')

@section('content')
<div class="container">
    <h2>Data Tagihan SPP</h2>
    <a href="{{ route('tagihan.create') }}" class="btn btn-primary mb-3">+ Tambah Tagihan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Aksi</th>
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
                            {{ $item->status == 'lunas' ? 'Lunas' : 'belum lunas' }}
                        </span>
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
            @empty
                <tr><td colspan="7" class="text-center">Belum ada data tagihan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
