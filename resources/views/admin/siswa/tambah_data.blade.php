@extends('layout.admin_template')

@section('title', 'Tambah Siswa')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h4 class="fw-semibold mb-4">➕ Tambah Siswa</h4>

            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">NISN</label>
                    <input type="text" name="nisn" class="form-control rounded-3 @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}" required>
                    @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama</label>
                    <input type="text" name="nama" class="form-control rounded-3 @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kelas</label>
                    <input type="text" name="kelas" class="form-control rounded-3 @error('kelas') is-invalid @enderror" value="{{ old('kelas') }}" required>
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control rounded-3 @error('jurusan') is-invalid @enderror" value="{{ old('jurusan') }}" required>
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary rounded-3">
                        ← Kembali
                    </a>
                    <button type="submit" class="btn btn-primary rounded-3">
                        💾 Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
