<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Invoice Transaksi Medistic</title>
    <style>
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            /* Mengganti font ke Arial */
            color: #333;
            margin: 0;
            padding: 20px;
            text-align: left;
            background: #f7f7f7;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        h1 {
            font-weight: bold;
            color: #000;
            margin: 0 0 10px;
            font-size: 24px;
        }

        h3 {
            font-weight: normal;
            color: #555;
            margin: 0 0 20px;
            font-size: 18px;
        }

        .header,
        .footer {
            text-align: center;
            margin: 20px 0;
        }

        .header p,
        .footer p {
            margin: 5px 0;
            font-size: 14px;
            color: #777;
        }

        .info-section {
            margin-bottom: 30px;
            padding: 10px;
            background: #f9f9f9;
            border-left: 4px solid #a0a98e;
        }

        .info-section p {
            margin: 5px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #a0a98e;
            color: white;
            font-weight: bold;
        }

        .total td {
            font-weight: bold;
        }

        .total td:last-child {
            border-top: 2px solid #ddd;
        }

        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }

            h1 {
                font-size: 20px;
            }

            h3 {
                font-size: 16px;
            }

            table th,
            table td {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="header">
            <h1>Invoice</h1>
            <h3>Transaksi Medistic</h3>
            <p>Surabaya | Telp: (0851-6661-8911) | Email: Medistic@gmail.com</p>
        </div>

        <div class="info-section">
            <p><strong>User ID:</strong> {{ auth()->user()->id }}</p>
            <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Alamat:</strong> {{ auth()->user()->alamat ?? 'Alamat tidak tersedia' }}</p>
            <p><strong>No HP:</strong> {{ auth()->user()->telepon ?? 'No HP tidak tersedia' }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
        </div>

        <div>
            <p><strong>Kode Pembayaran:</strong> {{ $transaksi->id }}</p>
            <p><strong>Status Pembayaran:</strong> {{ $transaksi->status }}</p>
        </div>


        <table>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Barang</th>
                <th>Jumlah</th>
                <th>Harga Total</th>
            </tr>

            @foreach ($transaksi->detailTransaksi as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->produk ? $detail->produk->nama_produk : 'Produk tidak ditemukan' }}</td>
                    <td>Rp. {{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>{{ $detail->quantity ? $detail->quantity : 'Quantity tidak ditemukan' }}</td>
                    <td>Rp. {{ number_format($detail->harga * $detail->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>

        <table>
            <tr class="total">
                <td colspan="3"></td>
                <td>SubTotal:</td>
                <td>Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td colspan="3"></td>
                <td>Total Bayar:</td>
                <td>Rp. {{ number_format($transaksi->total, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Terima Kasih Atas Pembeliannya. Semoga Sehat Selalu!</p>
            <p>STAMP Medistic</p>
        </div>
    </div>
</body>

</html>
