<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produk PDF</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <h2>Tanggal & Jam = {{ $date }}</h2>
    <table border="1" cellpadding="10" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Foto</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
            @foreach ($produk as $pr)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $pr->kode }}</td>
                    <td>{{ $pr->nama_produk }}</td>
                    <td>{{ $pr->harga }}</td>
                    <td>{{ $pr->foto }}</td>
                    <td>{{ $pr->deskripsi }}</td>
                    <td>{{ $pr->kategori->nama_kategori }}</td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>