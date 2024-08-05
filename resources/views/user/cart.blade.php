@extends('user.main_master')
@section('content')
<script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-jb569I_5pzmhsGaD"></script>

<section class="bg-light my-5">
    <div class="container vh-100">
        <div class="row">
            <h4 class="card-title mb-4">Your shopping cart</h4>
            <div class="col-lg-9">
                <div class="card border shadow-0">
                    @if ($userCarts->isEmpty())
                        <div>No Product Here</div>
                    @else
                        @foreach($userCarts as $cart)
                            <div class="m-4">
                                <div class="row gy-3 mb-4">
                                    <div class="col-lg-5">
                                        <div class="me-lg-5">
                                            <div class="d-flex">
                                                <img src="{{ asset('img-product/' . $cart->product->image) }}" class="border rounded me-3 w-50" alt="{{ $cart->product->name }}">
                                                <div class="">
                                                    <a href="{{ $cart->product->slug }}" class="nav-link text-black">{{ $cart->product->name }}</a>
                                                    <p class="text-muted">{{ $cart->product->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                                        <div class="">
                                            <text class="h6">Rp{{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}</text> <br />
                                        </div>
                                    </div>
                                    <div class="col-lg col-sm-6 d-flex justify-content-center justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                                        <div class="d-flex align-items-center">
                                            <form method="POST" action="{{ route('user.updatequantity', $cart->id) }}" class="d-flex align-items-center me-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" class="form-control me-2" name="quantity" min="1" max="{{ $cart->product->stock }}" value="{{ $cart->quantity }}">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('user.remove', $cart->id) }}" class="d-flex align-items-center">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card shadow-0 border">
                    <div class="card-body">
                        <ul class="list-group mb-3">
                        @foreach($userCarts as $cart)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6>{{ $cart->product->name }}</h6>
                                    <small class="text-muted">{{ $cart->quantity }} x Rp{{ number_format($cart->product->price, 0, ',', '.') }}</small>
                                </div>
                                <span class="text-muted">Rp{{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Total price:</p>
                            <p class="mb-2">Rp{{ number_format($totalPrice, 0, ',', '.') }}</p>
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-warning text-white w-100 my-auto" id="pay-button">
                                Check Out <i class="bi bi-caret-right-fill"></i>
                            </button>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-light w-100 border mt-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log(result);
                alert("Payment success!");
                sendPaymentResult(result);
            },
            onPending: function(result) {
                console.log(result);
                alert("Waiting for your payment!");
                sendPaymentResult(result);
            },
            onError: function(result) {
                console.log(result);
                alert("Payment failed!");
            },
            onClose: function() {
                alert('You closed without finishing the payment');
            }
        });
    };

    function sendPaymentResult(result) {
        fetch('{{ route('midtrans.notification') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(result)
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.status === 'success') {
            window.location.href = '{{ route('user.dashboard') }}';
        } else {
            alert('Payment processing error!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was a problem with the payment request.');
    });
    }
</script>

@endsection
