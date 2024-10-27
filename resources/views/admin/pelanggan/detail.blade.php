@extends('admin.layout.appadmin')
@section('content')

<ol class="breadcrumb mb-4 shadow" style="margin-top: 1rem;">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Pelanggan Detail</li>
</ol>

<div class="d-flex" style="margin-bottom: 1rem;">
    <a href="{{ url('admin/pelanggan') }}" class="btn btn-primary">Kembali</a>
</div>

<section style="background-color: #eee;">
    <div class="container py-5 shadow">
        @foreach ($pelanggan as $pel)
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><strong>Nama</strong></p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $pel->nama_pelanggan }}</p>
                            </div>
                        </div>
                        <hr>


                        <!-- Repeat the structure for other details -->

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><strong>Email</strong></p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $pel->email }}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><strong>Nomor Telepon</strong></p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $pel->telepon }}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><strong>Alamat</strong></p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $pel->alamat }}</p>
                            </div>
                        </div>
                        <hr>

                        <!-- Repeat the structure for other details -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection