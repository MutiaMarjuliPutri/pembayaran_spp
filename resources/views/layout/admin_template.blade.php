<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Admin - SMKAMPAY')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            background: linear-gradient(180deg, #0d6efd, #0b5ed7);
            color: #fff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar .nav-link {
            color: #fff;
            border-radius: .5rem;
            transition: background 0.3s;
        }
        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
        }
        .sidebar img {
            border-radius: 50%;
            background: #fff;
            padding: 4px;
        }
        .logout-button {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: .5rem 1rem;
            border-radius: .5rem;
            transition: background 0.3s;
        }
        .logout-button:hover {
            background: rgba(255,255,255,0.15);
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 sidebar" style="width: 250px; height: 100vh;">
        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-4 text-white text-decoration-none">
            <img src="{{ asset('gambar/logosekolah.png') }}" alt="Logo" width="40" class="me-2">
            <span class="fs-5 fw-semibold">SMK Payment</span>
        </a>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="{{ route('siswa.index') }}" class="nav-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}">Data Siswa</a></li>
            <li><a href="{{ route('spp.index') }}" class="nav-link {{ request()->routeIs('spp.index') ? 'active' : '' }}">Data SPP</a></li>
            <li><a href="{{ route('admin.tagihan.index') }}" class="nav-link {{ request()->routeIs('admin.tagihan.index') ? 'active' : '' }}">Tagihan SPP</a></li>
            <li><a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}">Laporan</a></li>
            <li><a href="{{ route('pengaturan.index') }}" class="nav-link {{ request()->routeIs('pengaturan.index') ? 'active' : '' }}">Pengaturan</a></li>
            <li class="nav-item"> <a class="nav-link {{ request()->is('admin/chat') ? 'active' : '' }}" href="{{ route('admin.chat.index') }}"> <i class="bi bi-chat-dots me-1"></i> Chat Siswa </a> </li>
            <li class="mt-3">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="p-4" style="flex: 1;">
        <div class="card shadow-sm rounded-3 p-4 bg-white">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
