@extends('layout.admin_template')

@section('title', 'Edit Status Tagihan')

@section('content')
<div class="container my-4">
    <h2>Edit Status Tagihan</h2>

    <form action="{{ route('admin.tagihan.update', $tagihan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            <option value="belum_lunas" {{ $tagihan->status == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
            <option value="lunas" {{ $tagihan->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.tagihan.index') }}" class="btn btn-secondary">Kembali</a>
</form>

</div>
@endsection
