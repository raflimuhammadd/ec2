@extends('admin.layout.appadmin')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@foreach ($pelanggan as $pel)
<h1 class="mt-4">Form Edit Pelanggan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<form method="POST" action="{{url('admin/pelanggan/update/'.$pel->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="nama_pelanggan" class="col-4 col-form-label">Nama Pelanggan</label>
        <div class="col-8">
            <input id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukan nama pelanggan" type="text" class="form-control" value="{{$pel->nama_pelanggan}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-4 col-form-label">Email</label>
        <div class="col-8">
            <input id="email" name="email" placeholder="Masukan email" type="email" class="form-control" value="{{$pel->email}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="telepon" class="col-4 col-form-label">Telepon</label>
        <div class="col-8">
            <input id="telepon" name="telepon" placeholder="masukkan nomor telepon" class="form-control" value="{{$pel->telepon}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="alamat" class="col-4 col-form-label">Alamat</label>
        <div class="col-8">
            <textarea id="alamat" name="alamat" cols="50" rows="5" class="form-control">{{$pel->alamat}}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
@endforeach
@endsection