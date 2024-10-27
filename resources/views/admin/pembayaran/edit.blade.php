@extends('admin.layout.appadmin')
@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @foreach ($pembayaran as $pem)
        <h1 class="mt-4">Form Input Produk</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>

        <form method="POST" action="{{ url('admin/pembayaran/update/' . $pem->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="tanggal_pembayaran" class="col-4 col-form-label">Tanggal Bayar</label>
                <div class="col-8">
                    <input id="tanggal_pembayaran" name="tanggal_pembayaran" value="{{ $pem->tanggal_pembayaran }}"
                        type="date" class="form-control">
                    @error('tanggal_pembayaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="jumlah_bayar" class="col-4 col-form-label">Jumlah Bayar</label>
                <div class="col-8">
                    <input id="jumlah_bayar" name="jumlah_bayar" value="{{ $pem->jumlah_bayar }}" type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="select" class="col-4 col-form-label">Tanggal Pesanan</label>
                <div class="col-8">
                    <select id="select" name="pesanan_id" class="custom-select">
                        @foreach ($pesanan as $pes)
                            <option value="{{ $pes->id }}">{{ $pes->tanggal_pesanan }}</option>
                        @endforeach
                    </select>
                    @error('pesanan_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    @endforeach
@endsection
