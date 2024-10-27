<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori PDF</title>
</head>

<body>
    <h1>{{ $title }}</h1>
    <h2>Tanggal & Jam = {{ $date }}</h2>
    <table border="1" cellpadding="10" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
            
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($kategori as $k)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{$k->nama_kategori}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>