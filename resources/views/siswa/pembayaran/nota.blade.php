<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; }
        .content { margin-top: 30px; }
        .content table { width: 100%; }
        .content th, .content td { text-align: left; padding: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nota Pembayaran SPP</h2>
        <small>SMK Contoh Indonesia</small>
    </div>

    <div class="content">
        <table>
            <tr><th>Bulan</th><td>{{ $tagihan->bulan }} {{ $tagihan->tahun }}</td></tr>
            <tr><th>Jumlah</th><td>Rp {{ number_format($tagihan->jumlah,0,',','.') }}</td></tr>
            <tr><th>Metode</th><td>{{ $tagihan->metode_pembayaran }}</td></tr>
            <tr><th>Status</th><td>{{ ucfirst($tagihan->status) }}</td></tr>
            <tr><th>Tanggal</th><td>{{ date('d-m-Y') }}</td></tr>
        </table>
    </div>
</body>
</html>
