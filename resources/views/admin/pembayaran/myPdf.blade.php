<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test PDF</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <h2>Tahun, Bulan, Tanggal, Jam = {{ $date }}</h2>
    <table border="1" cellpadding="10" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pembayaran</th>
                <th>Jumlah Pembayaran</th>
                <th>Tanggal Pesanan</th>
                <th>Status Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($pembayaran as $pem)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $pem->tanggal_pembayaran }}</td>
                    <td>{{ $pem->jumlah_bayar }}</td>
                    <td>{{ $pem->pesanan->tanggal_pesanan }}</td>
                    <td>{{ $pem->pesanan->status }}</td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Deskripsi</p>
</body>
</html>