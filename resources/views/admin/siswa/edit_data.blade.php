@extends('layout.admin_template')

@section('title', 'Edit Siswa')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h4 class="fw-semibold mb-4">✏️ Edit Siswa</h4>

            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">NISN</label>
                    <input type="text" name="nisn" class="form-control rounded-3 @error('nisn') is-invalid @enderror" 
                        value="{{ old('nisn', $siswa->nisn) }}" required>
                    @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama</label>
                    <input type="text" name="nama" class="form-control rounded-3 @error('nama') is-invalid @enderror" 
                        value="{{ old('nama', $siswa->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kelas</label>
                    <input type="text" name="kelas" class="form-control rounded-3 @error('kelas') is-invalid @enderror" 
                        value="{{ old('kelas', $siswa->kelas) }}" required>
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control rounded-3 @error('jurusan') is-invalid @enderror" 
                        value="{{ old('jurusan', $siswa->jurusan) }}" required>
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary rounded-3">
                        ← Kembali
                    </a>
                    <button type="submit" class="btn btn-primary rounded-3">
                        💾 Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
