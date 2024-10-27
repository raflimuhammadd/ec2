<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3 align="center">Data Pesanan</h3>
    <table border="1" cellpadding="10" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pesanan</th>
                <th>Status</th>
                <th>Nama Pelanggan</th>

            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($pesanan as $pes)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $pes->tanggal_pesanan }}</td>
                <td>{{ $pes->status }}</td>
                <td>{{ $pes->pelanggan->nama_pelanggan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>