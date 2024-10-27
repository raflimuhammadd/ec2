<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3 align="center">Data Pesanan Items</h3>
    <table border="1" cellpadding="10" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Nama Produk</th>
                <th>Tanggal Pesan</th>

            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($pesananItems as $pesi)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $pesi->qty }}</td>
                <td>{{ $pesi->harga }}</td>
                <td>{{ $pesi->produk->nama_produk }}</td>
                <td>{{ $pesi->pesanan->tanggal_pesanan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>