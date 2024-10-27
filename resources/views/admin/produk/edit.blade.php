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

@foreach ($produk as $pr)
<h1 class="mt-4">Form Edit Produk</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<form method="POST" action="{{url('admin/produk/update/'.$pr->id)}}" enctype="multipart/form-data">
@csrf
<div class="form-group row">
        <label for="text" class="col-4 col-form-label">Kode</label>
        <div class="col-8">
            <input id="text" name="kode" type="text" class="form-control" value="{{$pr->kode}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="nama_produk" class="col-4 col-form-label">Nama Produk</label>
        <div class="col-8">
            <input id="nama_produk" name="nama_produk" placeholder="Masukan nama produk" type="text" class="form-control" value="{{$pr->nama_produk}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-4 col-form-label">Harga</label>
        <div class="col-8">
            <input id="harga" name="harga" placeholder="Masukan harga" type="text" class="form-control" value="{{$pr->harga}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="text4" class="col-4 col-form-label">Foto</label>
        <div class="col-8">
            <input id="text4" name="foto" type="file" class="form-control">
            @if(!empty($pr->foto))
            <img src="{{url('admin/img')}}/{{$pr->foto}}" width="300px" height="300px"  alt="">

            @endif
        </div>

    </div>
    <div class="form-group row">
        <label for="deskripsi" class="col-4 col-form-label">Deskripsi</label>
        <div class="col-8">
            <textarea id="deskripsi" name="deskripsi" cols="50" rows="5" class="form-control">{{$pr->deskripsi}}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Kategori</label>
        <div class="col-8">
            <select id="select" name="kategori_id" class="custom-select">
                <option value="pilih">---Pilih Kategori---</option>
                @foreach ($kategori as $k)
                @php $sel = ($k->id == $pr->kategori_id) ? 'selected' : ''; @endphp
                <option value="{{$k->id}}" {{$sel}}>{{$k->nama_kategori}}</option>
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