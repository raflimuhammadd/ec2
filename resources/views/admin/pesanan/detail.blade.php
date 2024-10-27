@extends('admin.layout.appadmin')
@section('content')

@foreach ($pesanan as $pes)
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="" />
            </div>
            <div class="col-md-6">
                <div class="small mb-1"></div>
                <h1 class="display-5 fw-bolder">Detail Pesanan {{$pes->id}}</h1>
                <div class="fs-5 mb-5">
                    <span><strong>Tanggal Pesanan:</strong> {{$pes->tanggal_pesanan}}</span><br>
                    <span><strong>Status:</strong> {{$pes->status}}</span><br>
                    <span><strong>Nama Pelanggan:</strong> {{$pes->pelanggan->nama_pelanggan}}</span><br>
                </div>
            

                <div class="d-flex">
                
                        <a href="{{url('admin/pesanan')}}" type="button" class="btn btn-primary">Kembali</a>
                
                </div>
            </div>
        </div>
    </div>
</section>


@endforeach
@endsection