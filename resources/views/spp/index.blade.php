@extends('template')

@section('content')
<div class="container">
    <h2>Data SPP</h2>
    <a href="{{ route('spp.create') }}" class="btn btn-primary mb-3">+ Tambah SPP</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Nominal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($spp as $item)
                <tr>
                    <td>{{ $item->tahun }}</td>
                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                   <td>
    @if($item->status == 'Belum Lunas')
        <form action="{{ route('tagihan.bayar', $item->id) }}" method="POST" style="display:inline">
            @csrf
            @method('PUT')
            <button class="btn btn-sm btn-success" onclick="return confirm('Yakin ingin bayar?')">Bayar</button>
        </form>
    @endif

    <a href="{{ route('spp.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
    <form action="{{ route('tagihan.destroy', $item->id) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
    </form>
</td>

                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
