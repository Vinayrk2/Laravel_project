@extends('components.Layout')

@section('content')
<div class="container-fluid" style="margin-top: 70px;">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-10">
                </div>
                @if($cartItems->count() > 0)
                <div class="col-12">
                    <a href="{{ route('cart.clear') }}" class="btn w-100 border bg-light fs-5 fw-bold text-danger">
                        <i class="fa-solid fa-trash-can"></i> Remove All Items
                    </a>
                </div>
                @endif
            </div>

            @if($cartItems->count() > 0)
                @foreach($cartItems as $item)
                <div class="card mb-4 mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $item->product->image }}" alt="Cart Product Image" 
                                    class="rounded" style="mix-blend-mode: darken; height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <h5 class="card-title fs-4">{{ $item->product->name }}</h5>
                                <p class="card-text text-muted" style="margin-top: -8px;">
                                    {{ $item->product->category->name }}
                                </p>
                                <div class="col-auto">
                                    <div class="d-flex">
                                        <div>
                                            <p>Quantity: </p>
                                        </div>
                                        <div class="mx-3">
                                            <h5>
                                                <a href="{{ route('cart.decrement', $item->product_id) }}" 
                                                    style="text-decoration: none;">-</a>
                                            </h5>
                                        </div>
                                        <div>
                                            <h5>{{ $item->quantity }}</h5>
                                        </div>
                                        <div class="mx-3">
                                            <h5>
                                                <a href="{{ route('cart.increment', $item->product_id) }}" 
                                                    style="text-decoration: none;">+</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">
                                    <span class="fw-bold fs-4">${{ $item->product->adjusted_price }}
                                        <span style="font-size: 14px; font-weight: 600;">{{session('currency','CAD')}}</span>
                                    </span> per unit
                                </p>
                                <div class="row g-2 mb-3">
                                    <a href="{{ route('cart.remove', $item->product_id) }}" class="container">
                                        <button type="button" class="btn bg-light">Remove Item</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center fw-bold mt-3" style="width: 97vw;">
                    <img class="w-25 h-25" src="{{ asset('storage/'.'nocontant.png') }}" style="mix-blend-mode: darken;">
                    <h4>No items available in cart!</h4>
                </div>
            @endif
        </div>

        @if($cartItems->count() > 0)
        <div class="col-md-4 mt-md-5 pt-md-2">
            <div class="card">
                <div class="card-body bg-light">
                    <h2 class="card-title mb-4">Order Summary</h2>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>${{ number_format($subTotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Estimated Tax</span>
                        <span>${{ number_format($tax, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between pt-1 mb-2 fw-bold">
                        <span>Total Amount</span>
                        <span class="fw-bold" style="font-size: 18px;">${{ number_format($total, 2) }}</span>
                    </div>
                    <form action="{{ route('cart.checkout') }}" method="post" onsubmit="return confirmCheckout()">
                        @csrf
                        <button type="submit" class="btn w-100 mb-2 text-white" 
                            style="background-color: #090841;">Submit Order</button>
                    </form>
                    <a class="btn text-center d-block text-decoration-none"
                        href="{{ route('product-list-categorized', 'all') }}" 
                        style="color: #090841;">Continue Shopping >></a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 

@push('scripts')
<script>
function confirmCheckout() {
    return confirm('Are you sure you want to submit this order? An email confirmation will be sent to your email address.');
}
</script>
@endpush 