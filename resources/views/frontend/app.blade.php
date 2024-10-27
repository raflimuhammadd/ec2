<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="icon" href="{{ asset('user/img/medistic1.png') }}" type="image/png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <!-- cart -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend/css/style1.css') }}">
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <title>Medistic</title>
</head>

<body>
    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('user/img/medistic1.png') }}" width="80px" alt="Medistic Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                    <li><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>

                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->role == 'admin')
                                <li><a class="nav-link" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            @endif
                            <li>
                                <a class="nav-link" href="{{ url('profile') }}">
                                    {{ Auth::user()->name ?? Auth::user()->email }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('frmlogout').submit();"
                                    class="nav-link">Logout</a>
                                <form id="frmlogout" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="cartDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <button class="btn btn-outline-light position-relative">
                                        <i class="fa fa-shopping-cart"></i> Keranjang
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count((array) session('cart')) }}
                                        </span>
                                    </button>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="cartDropdown">
                                    <div class="row total-header-section">
                                        <div class="col-lg-6 col-sm-6 col-6">
                                            <i class="fa fa-shopping-cart"></i> <span
                                                class="badge bg-primary">{{ count((array) session('cart')) }}</span>
                                        </div>
                                        @php $total = 0 @endphp
                                        @foreach ((array) session('cart') as $id => $details)
                                            @php $total += $details['harga'] * $details['quantity'] @endphp
                                        @endforeach
                                        <div class="col-lg-6 col-sm-6 col-6 total-section text-end">
                                            <p>Total: <br><span>Rp. {{ $total }}</span></p>
                                        </div>
                                    </div>
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $details)
                                            <li class="dropdown-item cart-detail">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <img src="{{ $details['foto'] ? asset('admin/img/' . $details['foto']) : url('admin/img/nophoto.jpg') }}"
                                                            alt="Product Image" class="img-fluid">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <p>{{ $details['nama_produk'] }}</p>
                                                        <span class="text-danger">Rp. {{ $details['harga'] }}</span>
                                                        <span> Quantity: {{ $details['quantity'] }}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li class="dropdown-item text-center">
                                        <a href="{{ route('cart') }}" class="btn btn-primary btn-block">Lihat Semua</a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                                <li><a class="nav-link" href="{{ route('login') }}"><img
                                            src="{{ asset('frontend/images/user.svg') }}" alt="User Icon"></a></li>
                            </ul>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header/Navigation -->

    @yield('frontend')

    <footer class="footer-section">
        <div class="container relative">
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="mb-4 footer-logo-wrap">
                        <img src="{{ asset('user/img/medistic1.png') }}" width="180px" alt="Medistic Logo">
                    </div>
                    <p class="mb-4">Please follow us via the link below</p>
                    <ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                    </ul>
                </div>

                <div class="col-lg-8">
                    <div class="row links-wrap">
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Kontak</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Dukungan</a></li>
                                <li><a href="#">Live chat</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy; Medistic
                            <script>
                                document.write(new Date().getFullYear());
                            </script>.
                        </p>
                    </div>

                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer Section -->

    @yield('scripts')
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
</body>

</html>
