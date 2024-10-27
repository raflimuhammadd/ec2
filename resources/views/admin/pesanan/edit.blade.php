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

@foreach ($pesanan as $pes)
<h1 class="mt-4">Form Edit Pesanan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<form method="POST" action="{{url('admin/pesanan/update/'.$pes->id)}}" enctype="multipart/form-data">
@csrf
    
    <div class="form-group row">
        <label for="text3" class="col-4 col-form-label">Tanggal Pesanan</label>
        <div class="col-8">
            <input id="text3" name="tanggal_pesanan" type="date" class="form-control" value="{{$pes->tanggal_pesanan}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-4 col-form-label">Status</label>
        <div class="col-8">
            <input id="status" name="status" placeholder="Masukan status" type="text" class="form-control" value="{{$pes->status}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Pelanggan</label>
        <div class="col-8">
            <select id="select" name="pelanggan_id" class="custom-select">
                <option value="pilih">---Pilih pelanggan---</option>
                @foreach ($pelanggan as $pel)
                @php $sel = ($pel->id == $pes->pelanggan_id) ? 'selected' : ''; @endphp
                <option value="{{$pel->id}}" {{$sel}}>{{$pel->nama_pelanggan}}</option>
                @endforeach
            </select>
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