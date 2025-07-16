<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dashboard Siswa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            padding-top: 80px;
            background: #f4f6fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-premium {
            background: linear-gradient(90deg, #2f39f3, #5f6af7);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 0 0 18px 18px;
            padding: 12px 20px;
        }

        .navbar-premium .navbar-brand {
            font-weight: bold;
            color: #fff;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
        }

        .navbar-premium .navbar-brand img {
            width: 38px;
            height: 38px;
            margin-right: 10px;
            border-radius: 50%;
            background: #fff;
            padding: 3px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .navbar-premium .nav-link {
            color: #ddd;
            margin-right: 15px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .navbar-premium .nav-link:hover,
        .navbar-premium .nav-link.active {
            color: #fff;
            transform: translateY(-2px);
        }

        .navbar-premium .nav-link.active::after {
            content: '';
            display: block;
            height: 3px;
            width: 100%;
            background: #fff;
            border-radius: 2px;
            position: absolute;
            bottom: -6px;
            left: 0;
        }

        .badge-notify {
            background: #ff4d4f;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 12px;
        }

        .logout-button {
            background: transparent;
            border: none;
            color: #ddd;
            font-size: 15px;
            transition: all 0.3s;
        }

        .logout-button:hover {
            color: #fff;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-premium fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('siswa.dashboard_siswa') }}">
            <img src="{{ asset('gambar/logosekolah.png') }}" alt="Logo Sekolah">
            SMKKPAY
        </a>

        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list" style="font-size:1.5rem;"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}" href="{{ route('siswa.dashboard_siswa') }}">Home</a>
                </li>

                @php
                    $jumlahTagihanBelumLunas = \App\Models\TagihanSpp::whereHas('siswa', function($q){
                        $q->where('nisn', auth()->user()->nisn);
                    })->where('status', 'belum_lunas')->count();
                @endphp

                <li class="nav-item position-relative">
                    <a class="nav-link {{ request()->is('siswa/tagihan') ? 'active' : '' }}" href="{{ route('siswa.tagihan') }}">
                        Tagihan
                        @if($jumlahTagihanBelumLunas > 0)
                            <span class="badge-notify position-absolute top-0 start-100 translate-middle">{{ $jumlahTagihanBelumLunas }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/laporan') ? 'active' : '' }}" href="{{ route('siswa.laporan') }}">Riwayat</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/profil') ? 'active' : '' }}" href="{{ route('siswa.profil') }}">Profil</a>
                </li>

                <li class="nav-item"> <a class="nav-link {{ request()->is('siswa/chat') ? 'active' : '' }}" href="{{ route('siswa.chat') }}"> <i class="bi bi-chat-left-dots me-1"></i> Chat Admin </a> </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="logout-button" onclick="return confirm('Yakin ingin logout?')">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
