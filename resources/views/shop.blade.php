@extends('frontend.app')

@section('frontend')
    @if (Auth::check())
        <!-- Start Hero Section -->
        <div class="hero bg-light py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="intro-excerpt">
                            <h1 class="display-4">Shop</h1>
                            <p class="lead mb-4">Cari produk kesehatan yang Anda butuhkan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Hero Section -->

        <div class="untree_co-section product-section py-5">
            <div class="container">
                <div class="row">
                    @foreach ($produk as $product)
                        <!-- Product Item -->
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                            <div class="product-item border rounded overflow-hidden shadow-sm h-100">
                                <a href="{{ route('add.to.cart', $product->id) }}" class="text-decoration-none text-dark">
                                    <img src="{{ $product->foto ? url('admin/img/' . $product->foto) : url('admin/img/nofoto.jpg') }}"
                                        alt="{{ $product->nama_produk }}" class="img-fluid product-thumbnail"
                                        style="width: 100%; height: 250px; object-fit: cover;">
                                    <div class="p-3">
                                        <h5 class="product-title">{{ $product->nama_produk }}</h5>
                                        <p class="product-price text-success font-weight-bold">Rp.
                                            {{ number_format($product->harga, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="icon-cross position-absolute top-0 end-0 p-2">
                                        <img src="{{ asset('frontend/images/cross.svg') }}" class="img-fluid">
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Product Item -->
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <!-- User not authenticated - Prompt Login -->
        <div class="hero bg-light py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="intro-excerpt">
                            <h1 class="display-4">Shop</h1>
                            <p class="lead mb-4">Silahkan login untuk melihat produk kami.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="untree_co-section product-section py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Silahkan Login Terlebih Dahulu</a>
                </div>
            </div>
        </div>
    @endif
@endsection
