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

<h1 class="mt-4">Form Input Pesanan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<form method="POST" action="{{url('admin/pesanan/store')}}" enctype="multipart/form-data">
@csrf
    
    <div class="form-group row">
        <label for="text3" class="col-4 col-form-label">Tanggal Pesanan</label>
        <div class="col-8">
            <input id="text3" name="tanggal_pesanan" type="date" class="form-control @error('tanggal_pesanan') is-invalid @enderror">
            @error('tanggal_pesanan')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-4 col-form-label">Status</label>
        <div class="col-8">
            <input id="status" name="status" placeholder="Masukan status" type="text" class="form-control @error('status') is-invalid @enderror">
            @error('status')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Pelanggan</label>
        <div class="col-8">
            <select id="select" name="pelanggan_id" class="custom-select @error('pelanggan_id') is-invalid @enderror">
                <option value="pilih">---Pilih pelanggan---</option>
                @foreach ($pelanggan as $pel)
                <option value="{{$pel->id}}">{{$pel->nama_pelanggan}}</option>
                @endforeach
            </select>
            @error('pelanggan_id')
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