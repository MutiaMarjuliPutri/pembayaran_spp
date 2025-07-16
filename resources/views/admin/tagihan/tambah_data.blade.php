@extends('layout.admin_template')

@section('title', 'Tambah Tagihan SPP')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h4 class="fw-semibold mb-4">➕ Tambah Tagihan SPP</h4>

            <form action="{{ route('admin.tagihan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Siswa</label>
                    <select name="siswa_id" class="form-select rounded-3 @error('siswa_id') is-invalid @enderror" required>
                        <option value="">Pilih Siswa</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}" {{ old('siswa_id') == $s->id ? 'selected' : '' }}>
                                {{ $s->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('siswa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Nominal SPP</label>
                    <select name="spp_id" class="form-select rounded-3 @error('spp_id') is-invalid @enderror" required>
                        <option value="">Pilih Nominal SPP</option>
                        @foreach($spp as $s)
                            <option value="{{ $s->id }}" {{ old('spp_id') == $s->id ? 'selected' : '' }}>
                                {{ $s->tahun_ajaran }} - Rp{{ number_format($s->nominal, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('spp_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Bulan</label>
                    <select name="bulan" class="form-select rounded-3 @error('bulan') is-invalid @enderror" required>
                        <option value="">Pilih Bulan</option>
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bln)
                            <option value="{{ $bln }}" {{ old('bulan') == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                        @endforeach
                    </select>
                    @error('bulan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Tahun</label>
                    <input type="number" name="tahun" class="form-control rounded-3 @error('tahun') is-invalid @enderror" 
                           value="{{ old('tahun', date('Y')) }}" required>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.tagihan.index') }}" class="btn btn-secondary rounded-3">
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
