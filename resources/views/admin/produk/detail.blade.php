@extends('admin.layout.appadmin')
@section('content')

@foreach ($produk as $pr)
<section class="py-5">
<input type="hidden" value="{{$pr->id}}">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                @empty($pr->foto)
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{asset('admin/img/nofoto.jpg')}}" width="500px" height="500px" alt="..." /></div>
                    @else
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{asset('admin/img/'.$pr->foto)}}" width="500px" height="600px" alt="..." /></div>
                    @endempty
                    <div class="col-md-6">
                        <div class="small mb-1">{{$pr->kode}}</div>
                        <h1 class="display-5 fw-bolder">{{$pr->nama_produk}}</h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">$45.00</span>
                            <span>Rp. {{$pr->harga}}</span>
                        </div>
                        <p class="lead">{{$pr->deskripsi}}</p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                            <a href="{{url('admin/produk')}}" type="button" class="btn btn-primary ml-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endforeach
@endsection