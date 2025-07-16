@extends('layout.siswa_template')

@section('title', 'Edit Profil')

@section('content')

<style>
    .edit-profile-card {
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        max-width: 600px;
        margin: 0 auto;
    }
    .profile-preview {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        margin-bottom: 10px;
    }
    .btn-save {
        background: linear-gradient(90deg, #2f39f3, #4b5ff1);
        color: #fff;
        padding: 10px 30px;
        border-radius: 50px;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-save:hover {
        background: linear-gradient(90deg, #1d28d0, #3649e0);
        box-shadow: 0 5px 15px rgba(47,57,243,0.3);
    }
</style>

<div class="container my-5">
    <h3 class="fw-bold mb-4 text-primary"><i class="bi bi-pencil-square me-2"></i> Edit Profil</h3>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="edit-profile-card">

        <form action="{{ route('siswa.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Foto Profil --}}
            <div class="text-center mb-4">
                <img id="preview-foto" src="{{ Auth::user()->foto ? asset('uploads/gambar/' . Auth::user()->foto) : asset('default-avatar.png') }}" class="profile-preview" alt="Foto Profil">
                <div class="mt-2">
                    <input type="file" name="foto" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this)">
                    <small class="text-muted d-block mt-1">Format JPG/PNG maksimal 2MB</small>
                </div>
            </div>

            {{-- Nama --}}
            <div class="mb-3">
                <label class="fw-semibold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="fw-semibold">Password Baru</label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti">
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('siswa.profil') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-save">Simpan Perubahan</button>
            </div>

        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('preview-foto').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>


@endsection

