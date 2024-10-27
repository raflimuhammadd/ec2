@extends('frontend.app')

@section('frontend')

    <!-- Start Hero Section -->
    <div class="hero bg-light py-5">
        <div class="container">
            <h1 class="display-4">Keranjang Belanja</h1>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="container my-5">
        <div class="table-responsive">
            <table id="cart" class="table table-striped table-bordered align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col" style="width:40%">Produk</th>
                        <th scope="col" class="text-center" style="width:15%">Harga</th>
                        <th scope="col" class="text-center" style="width:10%">Quantity</th>
                        <th scope="col" class="text-center" style="width:20%">Subtotal</th>
                        <th scope="col" class="text-center" style="width:15%">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @if (session('cart'))
                        @foreach (session('cart') as $id => $details)
                            @php
                                $subtotal = $details['harga'] * $details['quantity'];
                                $total += $subtotal;
                            @endphp
                            <tr data-id="{{ $id }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $details['foto'] ? asset('admin/img/' . $details['foto']) : asset('admin/img/nophoto.jpg') }}"
                                            alt="{{ $details['nama_produk'] }}" class="img-thumbnail me-3"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                        <div>
                                            <h5 class="mb-0">{{ $details['nama_produk'] }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">Rp. {{ number_format($details['harga'], 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <input type="number" value="{{ $details['quantity'] }}" min="1"
                                        class="form-control quantity update-cart" style="width: 70px;">
                                </td>
                                <td class="text-center">Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger remove-from-cart"><i
                                            class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <h4>Keranjang anda kosong.</h4>
                                <a href="{{ url('shop') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
                @if (session('cart'))
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td colspan="2" class="text-center"><strong>Rp.
                                    {{ number_format($total, 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end">
                                <a href="{{ url('shop') }}" class="btn btn-outline-primary me-3"><i
                                        class="fa fa-angle-left"></i> Lanjut Belanja</a>
                                <form action="{{ url('transaksi') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <input type="hidden" name="total" value="{{ $total }}">
                                    @foreach (session('cart') as $id => $details)
                                        <input type="hidden" name="cart[{{ $id }}][harga]"
                                            value="{{ $details['harga'] }}">
                                        <input type="hidden" name="cart[{{ $id }}][quantity]"
                                            value="{{ $details['quantity'] }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-success">Checkout</button>
                                </form>
                            </td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(".update-cart").change(function(e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").data("id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function(e) {
            e.preventDefault();
            var ele = $(this);
            if (confirm("Anda yakin ingin menghapus produk ini?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").data("id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection
