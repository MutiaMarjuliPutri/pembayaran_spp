@extends('template')

@section('content')
<div class="container">
    <h2>Edit Tagihan SPP</h2>

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

    <form action="{{ route('tagihan.update', $tagihan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Siswa</label>
            <select name="siswa_id" class="form-control" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach ($siswa as $s)
                    <option value="{{ $s->id }}" {{ $tagihan->siswa_id == $s->id ? 'selected' : '' }}>
                        {{ $s->nama }} - {{ $s->kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Bulan</label>
            <select name="bulan" class="form-control" required>
                @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bln)
                    <option value="{{ $bln }}" {{ $tagihan->bulan == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" value="{{ $tagihan->tahun }}" required>
        </div>

        <div class="mb-3">
            <label>SPP (Nominal)</label>
            <select name="spp_id" class="form-control" required>
                <option value="">-- Pilih SPP --</option>
                @foreach ($spp as $sp)
                    <option value="{{ $sp->id }}" {{ $tagihan->spp_id == $sp->id ? 'selected' : '' }}>
                        {{ $sp->tahun }} - Rp {{ number_format($sp->nominal, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Lunas" {{ $tagihan->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="Belum Lunas" {{ $tagihan->status == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('tagihan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
