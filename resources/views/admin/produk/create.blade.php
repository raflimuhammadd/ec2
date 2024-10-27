@extends('admin.layout.appadmin')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 class="mt-4">Form Input Produk</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{url('admin/produk/store')}}" enctype="multipart/form-data">
@csrf
    <div class="form-group row">
        <label for="nama_produk" class="col-4 col-form-label">Kode</label>
        <div class="col-8">
            <input id="nama_produk" name="kode" placeholder="Masukan kode produk" type="text" class="form-control @error('kode') is-invalid @enderror">
            @error('kode')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="nama_produk" class="col-4 col-form-label">Nama Produk</label>
        <div class="col-8">
            <input id="nama_produk" name="nama_produk" placeholder="Masukan nama produk" type="text" class="form-control @error('nama_produk') is-invalid @enderror">
            @error('nama_produk')
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
        <label for="text4" class="col-4 col-form-label">Foto</label>
        <div class="col-8">
            <input id="text4" name="foto" type="file" class="form @error('foto') is-invalid @enderror">
            @error('foto')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="deskripsi" class="col-4 col-form-label">Deskripsi</label>
        <div class="col-8">
            <textarea id="deskripsi" name="deskripsi" cols="40" rows="5" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Kategori</label>
        <div class="col-8">
            <select id="select" name="kategori_id" class="custom-select @error('kategori_id') is-invalid @enderror">
                <option value="pilih">---Pilih Kategori---</option>
                @foreach ($kategori as $k)
                <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
                @endforeach
            </select>
            @error('kategori_id')
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