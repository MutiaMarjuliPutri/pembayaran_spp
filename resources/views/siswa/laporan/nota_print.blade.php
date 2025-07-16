<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pembayaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f5f7fa, #c3cfe2);
            padding: 40px 0;
        }
        .nota {
            max-width: 500px;
            margin: auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            padding: 30px;
            color: #333;
        }
        h2 {
            text-align: center;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        hr {
            border: none;
            height: 1px;
            background: #eee;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        td {
            padding: 10px 0;
            vertical-align: top;
        }
        td:first-child {
            color: #555;
            font-weight: 500;
            width: 35%;
        }
        td:last-child {
            color: #111;
            font-weight: 600;
        }
        .tanggal {
            text-align: right;
            margin-top: 40px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="nota">
        <h2>NOTA PEMBAYARAN SPP</h2>
        <hr>
        <table>
            <tr><td>Nama</td><td>: {{ $tagihan->siswa->nama }}</td></tr>
            <tr><td>NISN</td><td>: {{ $tagihan->siswa->nisn }}</td></tr>
            <tr><td>Bulan</td><td>: {{ $tagihan->bulan }} {{ $tagihan->tahun }}</td></tr>
            <tr><td>Jumlah</td><td>: Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</td></tr>
            <tr><td>Metode</td><td>: {{ $tagihan->metode }}</td></tr>
            <tr><td>Status</td><td>: Lunas</td></tr>
        </table>

        <p class="tanggal">
            {{ now()->format('d-m-Y') }}
        </p>
    </div>

</body>
</html>
