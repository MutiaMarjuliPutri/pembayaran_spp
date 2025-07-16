@extends('layout.siswa_template')

@section('title', 'Profil Siswa')

@section('content')

<style>
    .profile-card {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        transition: 0.3s ease;
    }
    .profile-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    }
    .profile-avatar {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: 0.3s ease;
    }
    .profile-avatar:hover {
        transform: scale(1.05);
    }
    .profile-table th {
        width: 40%;
        color: #555;
        font-weight: 600;
    }
    .btn-edit {
        background: linear-gradient(90deg, #f39c12, #f1c40f);
        color: #fff;
        padding: 10px 25px;
        border-radius: 50px;
        transition: 0.3s ease;
        font-weight: bold;
    }
    .btn-edit:hover {
        background: linear-gradient(90deg, #e67e22, #f39c12);
        box-shadow: 0 5px 15px rgba(243,156,18,0.4);
    }
</style>

<div class="container my-5">
    <h3 class="fw-bold mb-4 text-primary"><i class="bi bi-person-circle me-2"></i> Profil Saya</h3>

    <div class="profile-card text-center mx-auto" style="max-width: 600px;">

        {{-- Foto Profil --}}
        @if(Auth::user()->foto)
            <img src="{{ asset('uploads/gambar/' . Auth::user()->foto) }}" class="profile-avatar mb-3" alt="Foto Profil">
        @else
            <img src="{{ asset('default-avatar.png') }}" class="profile-avatar mb-3" alt="Default Avatar">
        @endif

        {{-- Data Siswa --}}
        <table class="table table-borderless mt-4 text-start profile-table">
            <tr>
                <th>NISN</th>
                <td>{{ $siswa->nisn }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $siswa->nama }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $siswa->kelas }}</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>{{ $siswa->jurusan }}</td>
            </tr>
            <tr>
                <th>Tahun Masuk</th>
                <td>{{ $siswa->tahun_masuk }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ Auth::user()->email }}</td>
            </tr>
        </table>

        <a href="{{ route('siswa.profil.edit') }}" class="btn btn-edit mt-4">
            <i class="bi bi-pencil-square me-1"></i> Edit Profil
        </a>

    </div>
</div>

@endsection
