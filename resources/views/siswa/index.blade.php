@extends('template')

@section('content')
<div class="container">
    <h2>Data Siswa</h2>
    <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3">+ Tambah Siswa</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NISN</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tahun Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswa as $item)
                <tr>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->tahun_masuk }}</td>
                    <td>
                        <a href="{{ route('siswa.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
