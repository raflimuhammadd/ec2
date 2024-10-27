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

@foreach ($pesananItems as $pesi)
<h1 class="mt-4">Form Edit Pesanan Items</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<form method="POST" action="{{url('admin/pesananItems/update/'.$pesi->id)}}" enctype="multipart/form-data">
@csrf
    
    <div class="form-group row">
        <label for="harga" class="col-4 col-form-label">QTY</label>
        <div class="col-8">
            <input id="qty" name="qty" placeholder="Masukan qty" type="text" class="form-control" value="{{$pesi->qty}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-4 col-form-label">Harga</label>
        <div class="col-8">
            <input id="harga" name="harga" placeholder="Masukan harga" type="text" class="form-control" value="{{$pesi->harga}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Nama Produk</label>
        <div class="col-8">
            <select id="select" name="produk_id" class="custom-select">
                <option value="pilih">---Pilih produk---</option>
                @foreach ($produk as $pr)
                @php $sel = ($pr->id == $pesi->produk_id) ? 'selected' : ''; @endphp
                <option value="{{$pr->id}}" {{$sel}}>{{$pr->nama_produk}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Tanggal Pesan</label>
        <div class="col-8">
            <select id="select" name="pesanan_id" class="custom-select">
                <option value="pilih">---Pilih tanggal pesan---</option>
                @foreach ($pesanan as $pes)
                @php $sel = ($pes->id == $pesi->pesanan_id) ? 'selected' : ''; @endphp
                <option value="{{$pes->id}}" {{$sel}}>{{$pes->tanggal_pesanan}}</option>
                @endforeach
            </select>
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