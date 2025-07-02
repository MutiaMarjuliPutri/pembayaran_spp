@extends('template')

@section('content')
<div class="container">
    <h2>Tambah Data SPP</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan:<br>
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('spp.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" required value="{{ old('tahun') }}">
        </div>

        <div class="mb-3">
            <label>Nominal (Rp)</label>
            <input type="number" name="nominal" class="form-control" required value="{{ old('nominal') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('spp.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
