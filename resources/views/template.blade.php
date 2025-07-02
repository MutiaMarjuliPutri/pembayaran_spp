<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Pembayaran SPP')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Pembayaran SPP</a>
            <div>
                <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-light me-2">Siswa</a>
                <a href="{{ route('spp.index') }}" class="btn btn-sm btn-light">SPP</a>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer class="text-center mt-5 mb-3 text-muted">
        &copy; {{ date('Y') }} Bro Mutia - SPP App
    </footer>

</body>
</html>
