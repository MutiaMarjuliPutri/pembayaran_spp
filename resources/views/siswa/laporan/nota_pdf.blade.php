<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .title { text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    

    <div class="title">NOTA PEMBAYARAN SPP</div>

    <table>
        <tr>
            <td>Nama</td><td>: {{ $tagihan->siswa->nama }}</td>
        </tr>
        <tr>
            <td>NISN</td><td>: {{ $tagihan->siswa->nisn }}</td>
        </tr>
        <tr>
            <td>Bulan</td><td>: {{ $tagihan->bulan }} {{ $tagihan->tahun }}</td>
        </tr>
        <tr>
            <td>Jumlah</td><td>: Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Metode</td><td>: {{ $tagihan->metode }}</td>
        </tr>
    </table>

    <p style="margin-top: 20px; text-align: right;">
        Tanggal Cetak: {{ now()->format('d-m-Y') }}
    </p>

</body>
</html>
