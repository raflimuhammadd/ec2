@extends('admin.layout.appadmin')
@section('content')
    {{-- <link rel="stylesheet" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css"
        integrity="sha384-jbCTJB16Q17718YM9U22iJkhuGbS0Gd2LjaWb4YJEZToOPmnKDjySVa323U+W7Fv" crossorigin="anonymous"> --}}
    <style>
        body {
            margin-top: 20px;
            background: #eee;
        }

        /* My Account */
        .payments-item img.mr-3 {
            width: 47px;
        }

        .order-list .btn {
            border-radius: 2px;
            min-width: 121px;
            font-size: 13px;
            padding: 7px 0 7px 0;
        }

        .osahan-account-page-left .nav-link {
            padding: 18px 20px;
            border: none;
            font-weight: 600;
            color: #535665;
        }

        .osahan-account-page-left .nav-link i {
            width: 28px;
            height: 28px;
            background: #535665;
            display: inline-block;
            text-align: center;
            line-height: 29px;
            font-size: 15px;
            border-radius: 50px;
            margin: 0 7px 0 0px;
            color: #fff;
        }

        .osahan-account-page-left .nav-link.active {
            background: #f3f7f8;
            color: #282c3f !important;
        }

        .osahan-account-page-left .nav-link.active i {
            background: #282c3f !important;
        }

        .osahan-user-media img {
            width: 90px;
        }

        .card offer-card h5.card-title {
            border: 2px dotted #000;
        }

        .card.offer-card h5 {
            border: 1px dotted #daceb7;
            display: inline-table;
            color: #17a2b8;
            margin: 0 0 19px 0;
            font-size: 15px;
            padding: 6px 10px 6px 6px;
            border-radius: 2px;
            background: #fffae6;
            position: relative;
        }

        .card.offer-card h5 img {
            height: 22px;
            object-fit: cover;
            width: 22px;
            margin: 0 8px 0 0;
            border-radius: 2px;
        }

        .card.offer-card h5:after {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid #daceb7;
            content: "";
            left: 30px;
            position: absolute;
            bottom: 0;
        }

        .card.offer-card h5:before {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid #daceb7;
            content: "";
            left: 30px;
            position: absolute;
            top: 0;
        }

        .payments-item .media {
            align-items: center;
        }

        .payments-item .media img {
            margin: 0 40px 0 11px !important;
        }

        .reviews-members .media .mr-3 {
            width: 56px;
            height: 56px;
            object-fit: cover;
        }

        .order-list img.mr-4 {
            width: 70px;
            height: 70px;
            object-fit: cover;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
            border-radius: 2px;
        }

        .osahan-cart-item p.text-gray.float-right {
            margin: 3px 0 0 0;
            font-size: 12px;
        }

        .osahan-cart-item .food-item {
            vertical-align: bottom;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #000000;
        }

        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }

        a:hover {
            text-decoration: none;
        }
    </style>

    <div class="container mt-5 mb-5">
        <div class="row">
            @foreach ($transaksi as $trans)
                <div class="col-md-3">
                    <div class="osahan-account-page-left shadow-sm bg-white h-100">
                        <div class="border-bottom p-4">
                            <div class="osahan-user text-center">
                                <div class="osahan-user-media">
                                    <img class="mb-3 rounded-pill shadow-sm mt-1"
                                        src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="gurdeep singh osahan">
                                    <div class="osahan-user-media-body">
                                        <h6 class="mb-2">{{ $trans->nama }}</h6>
                                        <p class="mb-1">{{ $trans->telp }}</p>
                                        <p>{{ $trans->email }}</p>
                                        <p>Total Harga Rp. {{ number_format($trans->total, 0, ',', '.') }}</p>
                                        @if ($trans->status == 'tidak')
                                            <p>Paid/Unpaid : Unpaid</p>
                                        @else
                                            <p>Paid/Unpaid : Paid</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-md-9">
                <div class="osahan-account-page-right shadow-sm bg-white p-4 h-100">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade  active show" id="favourites" role="tabpanel"
                            aria-labelledby="favourites-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Detail</h4>
                            <div class="row">
                                @foreach ($detail as $det)
                                    <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                        <div
                                            class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                            <div class="list-card-image">

                                            </div>
                                            <div class="p-3 position-relative">
                                                <div class="list-card-body">
                                                    <h6 class="mb-1">
                                                        <h3 class="text-black">
                                                            {{ $det->nama_produk }}
                                                        </h3>
                                                    </h6>
                                                    <p class="text-gray mb-3">Quantity {{ $det->quantity }}</p>
                                                    <p class="text-gray mb-3">Harga Produk Rp.
                                                        {{ number_format($det->harga, 0, ',', '.') }}</p>
                                                    {{-- <p class="text-gray mb-3 time"><span
                                                            class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                                class="icofont-wall-clock"></i> 15–30 min</span> <span
                                                            class="float-right text-black-50"> $350 FOR TWO</span></p> --}}
                                                </div>
                                                {{-- <div class="list-card-badge">
                                                    <span class="badge badge-danger">OFFER</span> <small> Use Coupon
                                                        OSAHAN50</small>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-12 text-center load-more">
                                    <a href="{{ url('admin/transaksi') }}" class="btn btn-primary" type="button">
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true">
                                        </span> Keluar...
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
