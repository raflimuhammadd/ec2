@extends('admin.layout.appadmin')
@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @foreach ($transaksi as $tran)
        <h1 class="mt-4">Form Input Transaksi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <br>
        <form method="POST" action="{{ url('admin/transaksi/update/' . $tran->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="text" class="col-3 col-form-label">Status Transaksi</label>
                <div class="col-6">
                    <select name="status" id="" class="form-control">
                        <option value="lunas">Lunas</option>
                        <option value="tidak">Belum Lunas</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-3 col-6">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    @endforeach
@endsection
