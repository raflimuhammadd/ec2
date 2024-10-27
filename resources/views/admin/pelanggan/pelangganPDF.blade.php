<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3 align="center">Data Pelanggan</h3>
    <table border="1" cellpadding="10" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($pelanggan as $pel)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $pel->nama_pelanggan }}</td>
                <td>{{ $pel->email }}</td>
                <td>{{ $pel->telepon }}</td>
                <td>{{ $pel->alamat }}</td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>