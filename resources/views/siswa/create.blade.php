@extends('template')

@section('content')
<div class="container">
    <h2>Tambah Siswa</h2>

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

    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>NISN</label>
            <input type="text" name="nisn" class="form-control" required value="{{ old('nisn') }}">
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" required value="{{ old('kelas') }}">
        </div>

        <div class="mb-3">
            <label>Tahun Masuk</label>
            <input type="number" name="tahun_masuk" class="form-control" required value="{{ old('tahun_masuk') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
