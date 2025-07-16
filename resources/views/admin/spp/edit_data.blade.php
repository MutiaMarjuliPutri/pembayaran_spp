@extends('layout.admin_template')

@section('title', 'Edit SPP')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h4 class="fw-semibold mb-4">✏️ Edit SPP</h4>

            <form action="{{ route('spp.update', $spp->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tahun</label>
                    <input type="number" name="tahun" maxlength="4" 
                           class="form-control rounded-3 @error('tahun') is-invalid @enderror"
                           value="{{ old('tahun', $spp->tahun) }}" required>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Nominal</label>
                    <input type="number" name="nominal" 
                           class="form-control rounded-3 @error('nominal') is-invalid @enderror"
                           value="{{ old('nominal', $spp->nominal) }}" required>
                    @error('nominal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('spp.index') }}" class="btn btn-secondary rounded-3">
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
