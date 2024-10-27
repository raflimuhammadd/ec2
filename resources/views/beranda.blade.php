@extends('frontend.app')

@section('frontend')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Selamat Datang di <span class="d-block">Medistic</span></h1>
                        <p class="mb-4">Selamat datang di Medistic, apotek terpercaya Anda yang menyediakan solusi
                            kesehatan terbaik!</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('frontend/images/littman2.png') }}" class="img-fluid" alt="Hero Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <div class="product-section py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="mb-4 section-title">Pilih Produk Kesehatan yang Anda Butuhkan</h2>
                    <p class="mb-4 text-muted">Cari dan temukan produk kesehatan terbaik untuk kebutuhan Anda di sini.</p>
                </div>
            </div>
            <div class="row justify-content-center"> <!-- Centering the row -->
                @forelse ($produk as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-4"> <!-- Adjusted to fit 5 products -->
                        <div class="card product-card h-100 shadow-sm border-0">
                            <div class="card-img-top position-relative">
                                <img src="{{ $product->foto ? url('admin/img/' . $product->foto) : url('admin/img/nofoto.jpg') }}"
                                    class="img-fluid w-100" style="height: 250px; object-fit: cover;"
                                    alt="{{ $product->nama_produk }}">
                                <div class="overlay-hover position-absolute w-100 h-100"
                                    style="top: 0; left: 0; background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s;">
                                    <div class="text-center text-white"
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                        <a href="#" class="btn btn-light">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title h5">{{ $product->nama_produk }}</h3>
                                <p class="card-text text-success font-weight-bold">Rp.
                                    {{ number_format($product->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Tidak ada produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- End Product Section -->


    <script>
        // Hover effect for product cards
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('mouseover', () => {
                card.querySelector('.overlay-hover').style.opacity = 1;
            });
            card.addEventListener('mouseout', () => {
                card.querySelector('.overlay-hover').style.opacity = 0;
            });
        });
    </script>


    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section position-relative"
        style="background: url('{{ asset('frontend/images/apotek-4.jpg') }}') center center/cover no-repeat; padding: 80px 0;">
        <div class="overlay"
            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.8);"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="section-title text-white">Kenapa harus Medistic?</h2>
                    <p class="text-white">Pada Medistic, kami mengutamakan kesehatan dan kepuasan pelanggan. Kami
                        menyediakan
                        berbagai produk farmasi berkualitas tinggi dengan harga yang kompetitif. Tim ahli kami siap membantu
                        menjawab pertanyaan Anda dan memberikan rekomendasi yang sesuai dengan kebutuhan kesehatan Anda.
                        Medistic bukan hanya sekadar apotek; kami adalah mitra kesehatan Anda yang terpercaya.</p>
                </div>
            </div>
            <div class="row">
                @foreach ([
            ['icon' => 'truck.svg', 'title' => 'Pengiriman Cepat & Gratis', 'description' => 'Kami memahami betapa pentingnya mendapatkan obat dan produk kesehatan Anda tepat waktu. Oleh karena itu, Medistic menawarkan layanan pengiriman yang cepat dan gratis untuk semua pesanan. Anda tidak perlu khawatir tentang biaya tambahan, cukup lakukan pemesanan dan kami akan mengantarkan langsung ke pintu rumah Anda.'],
            ['icon' => 'bag.svg', 'title' => 'Belanja dengan mudah', 'description' => 'Di Medistic, kami memastikan pengalaman belanja yang mudah dan menyenangkan. Dengan antarmuka yang user-friendly di situs web kami, Anda dapat mencari dan membeli produk dengan cepat. Cukup pilih produk yang Anda inginkan, dan selesaikan proses pembayaran dalam beberapa langkah saja. Kami juga menyediakan berbagai metode pembayaran untuk kenyamanan Anda.'],
            ['icon' => 'support.svg', 'title' => 'Pelayanan 24/7', 'description' => 'Kesehatan tidak mengenal waktu, dan kami di Medistic memahami itu. Kami menawarkan pelayanan 24 jam untuk memastikan Anda selalu mendapatkan bantuan yang Anda butuhkan kapan saja. Apakah Anda memiliki pertanyaan tentang produk atau memerlukan konsultasi kesehatan, tim kami siap sedia untuk membantu Anda setiap saat.'],
            ['icon' => 'return.svg', 'title' => 'Pengembalian Barang & Dana dengan mudah', 'description' => 'Kepuasan Anda adalah prioritas utama kami. Jika Anda tidak puas dengan produk yang Anda terima atau jika ada kesalahan dalam pengiriman, kami menyediakan proses refund yang mudah dan cepat. Cukup hubungi layanan pelanggan kami, dan kami akan membantu Anda menyelesaikan masalah tersebut dengan cepat.'],
        ] as $feature)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="feature text-center p-4 bg-white rounded shadow-sm h-100">
                            <div class="icon mb-3">
                                <img src="{{ asset('frontend/images/' . $feature['icon']) }}" alt="{{ $feature['title'] }}"
                                    class="img-fluid" style="width: 50px;">
                            </div>
                            <h3 class="h5">{{ $feature['title'] }}</h3>
                            <p class="small text-muted">{{ $feature['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->


    <!-- Start Popular Product Section -->
    <div class="popular-product py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Produk Populer</h2>
                    <p>Jelajahi koleksi produk populer kami yang telah terbukti efektif dan banyak direkomendasikan oleh
                        pelanggan. </p>
                </div>
            </div>
            <div class="row">
                @foreach ([['image' => 'ponstan.jpg', 'title' => 'Ponstan', 'description' => 'Obat untuk mengurangi atau menghilangkan rasa sakit'], ['image' => 'ventolin.jpeg', 'title' => 'Ventolin', 'description' => 'Obat asma inhaler'], ['image' => 'santadex.jpg', 'title' => 'SantaDex', 'description' => 'Obat tetes telinga']] as $product)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card product-card h-100 shadow-sm border-0">
                            <div class="card-img-top position-relative">
                                <img src="{{ asset('frontend/images/' . $product['image']) }}"
                                    alt="{{ $product['title'] }}" class="img-fluid w-100"
                                    style="height: 250px; object-fit: cover;">
                                <div class="overlay-hover position-absolute w-100 h-100"
                                    style="top: 0; left: 0; background-color: rgba(0, 0, 0, 0.4); opacity: 0; transition: opacity 0.3s;">
                                    <div class="text-center text-white"
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                        <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title h5">{{ $product['title'] }}</h3>
                                <p class="card-text text-muted">{{ $product['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Popular Product Section -->

    <script>
        // Hover effect for product cards
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('mouseover', () => {
                card.querySelector('.overlay-hover').style.opacity = 1;
            });
            card.addEventListener('mouseout', () => {
                card.querySelector('.overlay-hover').style.opacity = 0;
            });
        });
    </script>
@endsection
