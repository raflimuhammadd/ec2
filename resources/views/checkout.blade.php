@extends('frontend.app')

@section('frontend')
    <!-- Start Hero Section -->
    <div class="hero bg-light py-5">
        <div class="container">
            <h1 class="display-4">Checkout</h1>
            <p class="lead">Please review and confirm your order below.</p>
        </div>
    </div>
    <!-- End Hero Section -->

    @if (session('cart'))
        <div class="container my-5">
            <div class="row">
                <!-- User Details -->
                <div class="col-md-6">
                    <h4>User Details</h4>
                    <div class="border p-4 bg-white rounded">
                        <div class="mb-3">
                            <label for="user-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user-name" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="user-address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="user-address"
                                value="{{ auth()->user()->alamat }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="user-phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="user-phone"
                                value="{{ auth()->user()->telepon }}">
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-md-6">
                    <h4>Your Order</h4>
                    <div class="border p-4 bg-white rounded">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0 @endphp
                                @foreach (session('cart') as $id => $details)
                                    @php
                                        $subtotal = $details['harga'] * $details['quantity'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $details['nama_produk'] }} <span class="text-muted">x
                                                {{ $details['quantity'] }}</span></td>
                                        <td class="text-end">Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-light">
                                    <th>Order Total</th>
                                    <th class="text-end">Rp. {{ number_format($total, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="text-end mt-4">
                            <button class="btn btn-primary btn-lg" id="pay-button">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = '{!! route('success', ['id' => session('cart') ? $transaksi->id : null]) !!}';
                    console.log(result);
                },
                onPending: function(result) {
                    alert("Awaiting payment.");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    alert("Payment popup closed without completing payment.");
                }
            });
        });
    </script>
@endsection
