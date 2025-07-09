@extends('template')

@section('content')
<div class="container">
    <h2>Tambah Tagihan SPP</h2>

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

    <form action="{{ route('tagihan.store') }}" method="POST">
        @csrf

       <div class="mb-3">
    <label>Kelas</label>
    <select name="kelas" class="form-control" required>
        <option value="">-- Pilih Kelas --</option>
        @foreach ($kelasList as $kls)
            <option value="{{ $kls }}" {{ old('kelas') == $kls ? 'selected' : '' }}>
                {{ $kls }}
            </option>
        @endforeach
    </select>
</div>


        <div class="mb-3">
            <label>Bulan</label>
            <select name="bulan" class="form-control" required>
                <option value="">-- Pilih Bulan --</option>
                @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bln)
                    <option value="{{ $bln }}" {{ old('bulan') == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" value="{{ old('tahun') }}" required>
        </div> --}}

        <div class="mb-3">
            <label>SPP (Nominal)</label>
            <select name="spp_id" class="form-control" required>
                <option value="">-- Pilih Tahun SPP --</option>
                @foreach ($spp as $sp)
                    <option value="{{ $sp->id }}" {{ old('spp_id') == $sp->id ? 'selected' : '' }}>
                        {{ $sp->tahun }} - Rp {{ number_format($sp->nominal, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <option value="lunas" {{ old('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="belum_bayar" {{ old('status') == 'belum_bayar' ? 'selected' : '' }}>Belum Lunas</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('tagihan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
