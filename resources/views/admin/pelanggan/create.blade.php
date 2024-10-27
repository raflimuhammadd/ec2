@extends('admin.layout.appadmin')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 class="mt-4">Form Input Data Pelanggan</h1>
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

<form method="POST" action="{{url('admin/pelanggan/store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="nama_pelanggan" class="col-4 col-form-label">Nama Pelanggan</label>
        <div class="col-8">
            <input id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukan nama pelanggan" type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror">
            @error('nama_pelanggan')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-4 col-form-label">Email</label>
        <div class="col-8">
            <input id="email" name="email" placeholder="Masukan email" type="email" class="form-control @error('email') is-invalid @enderror">
            @error('email')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="telepon" class="col-4 col-form-label">Nomor Telepon</label>
        <div class="col-8">
            <input id="telepon" name="telepon" placeholder="masukkan nomor telepon" cols="40" rows="5" class="form-control @error('telepon') is-invalid @enderror">
            @error('telepon')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="alamat" class="col-4 col-form-label">Alamat</label>
        <div class="col-8">
            <textarea id="alamat" name="alamat" cols="40" rows="5" class="form-control @error('alamat') is-invalid @enderror"></textarea>
            @error('alamat')
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