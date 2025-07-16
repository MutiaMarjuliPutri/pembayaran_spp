<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - SMKAMPAY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #d0e7ff, #f0f9ff);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 950px;
            width: 100%;
            display: flex;
            min-height: 500px;
        }

        .login-image {
            flex: 1;
            background: url('{{ asset('gambar/sekolah.jpg') }}') center center / cover no-repeat;
            position: relative;
        }

        .login-image::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.3);
        }

        .login-form {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-form h4 {
            color: #3366cc;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .login-form p {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-control {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 15px;
        }

        .btn-login {
            background: #3366cc;
            color: white;
            border: none;
            padding: 12px 0;
            width: 100%;
            border-radius: 8px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #2952a3;
        }

        .link-login {
            margin-top: 15px;
            font-size: 14px;
            color: #3366cc;
            text-decoration: none;
            transition: 0.3s;
        }

        .link-login:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="login-container">
    <div class="login-image d-flex justify-content-center align-items-center">
    </div>

    <div class="login-form">
        <img src="{{ asset('gambar/logosekolah.png') }}" alt="Logo Sekolah" width="100" class="position-relative z-1">
        <h4 class="mb-1">SMKAMPAY</h4>
        <p>Masuk untuk mengakses pembayaran & tagihan SPP Anda</p>

        @if(session('error'))
            <div class="alert alert-danger w-100">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" style="width:100%; max-width:400px;">
            @csrf

            <div class="mb-3 text-start">
                <label class="form-label">Email Admin / NISN Siswa</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan Email atau NISN" required>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label">Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
            </button>

            <a href="#" class="link-login"><i class="bi bi-question-circle"></i> Lupa Password?</a>
        </form>

    </div>
</div>

</body>
</html>
