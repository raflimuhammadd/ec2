@extends('admin.layout.appadmin')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<h1 class="mt-4">Form Input Pesanan Items</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<form method="POST" action="{{url('admin/pesananItems/store')}}" enctype="multipart/form-data">
@csrf
    
    <div class="form-group row">
        <label for="harga" class="col-4 col-form-label">QTY</label>
        <div class="col-8">
            <input id="qty" name="qty" placeholder="Masukan qty" type="text" class="form-control @error('qty') is-invalid @enderror">
            @error('qty')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-4 col-form-label">Harga</label>
        <div class="col-8">
            <input id="harga" name="harga" placeholder="Masukan harga" type="text" class="form-control @error('harga') is-invalid @enderror">
            @error('harga')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Nama Produk</label>
        <div class="col-8">
            <select id="select" name="produk_id" class="custom-select @error('produk_id') is-invalid @enderror">
                <option value="pilih">---Pilih produk---</option>
                @foreach ($produk as $pr)
                <option value="{{$pr->id}}">{{$pr->nama_produk}}</option>
                @endforeach
            </select>
            @error('produk_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Tanggal Pesan</label>
        <div class="col-8">
            <select id="select" name="pesanan_id" class="custom-select @error('pesanan_id') is-invalid @enderror">
                <option value="pilih">---Pilih tanggal pesan---</option>
                @foreach ($pesanan as $pes)
                <option value="{{$pes->id}}">{{$pes->tanggal_pesanan}}</option>
                @endforeach
            </select>
            @error('pesanan_id')
            <div class="invalid-feedback">
                {{$message}}
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

@endsection