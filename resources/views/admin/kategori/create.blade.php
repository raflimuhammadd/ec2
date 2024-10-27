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

<h1 class="mt-4">Form Input Kategori</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>
<br>
<form  method="POST" action="{{url('admin/kategori/store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="text" class="col-3 col-form-label">Nama Kategori</label>
        <div class="col-6">
            <input id="text" name="nama_kategori" placeholder="Masukan kategori" type="text" class="form-control @error('nama_kategori') is-invalid @enderror">
            @error('nama_kategori')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-3 col-6">
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

@endsection