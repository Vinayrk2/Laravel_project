@extends('components.Layout')

@section('content')
<div class="container-fluid py-5" style="margin-top: 70px; background-color: #f8f9fa;">
    <div class="container">
        @if($cartItems->count() > 0)
        <h1 class="text-center mb-5">Your Shopping Cart</h1>
        <div class="row">
            <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h4">Cart Items ({{ $cartItems->count() }})</h2>
                        <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger">
                            <i class="fa-solid fa-trash-can me-2"></i>Remove All Items
                        </a>
                    </div>
                    @foreach($cartItems as $item)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" 
                                        class="img-fluid rounded" style="mix-blend-mode: darken; max-height: 150px; object-fit: contain;">
                                </div>
                                <div class="col-md-9">
                                    <h5 class="card-title">{{ $item->product->name }}</h5>
                                    <p class="text-muted mb-2">{{ $item->product->category->name }}</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="me-3">Quantity:</span>
                                        <div class="btn-group" role="group" aria-label="Quantity controls">
                                            <a href="{{ route('cart.decrement', $item->product_id) }}" class="btn btn-outline-secondary btn-sm">-</a>
                                            <span class="btn btn-outline-secondary btn-sm disabled">{{ $item->quantity }}</span>
                                            <a href="{{ route('cart.increment', $item->product_id) }}" class="btn btn-outline-secondary btn-sm">+</a>
                                        </div>
                                    </div>
                                    <p class="card-text mb-3">
                                        <span class="fw-bold fs-5">${{ number_format($item->product->adjusted_price, 2) }}</span>
                                        <span class="text-muted ms-2">{{ session('currency', 'CAD') }} per unit</span>
                                    </p>
                                    <a href="{{ route('cart.remove', $item->product_id) }}" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-trash-can me-2"></i>Remove Item
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                   
                    <div class="text-center py-5 col">
                        <img src="{{ asset('storage/nocontant.png') }}" alt="Empty Cart" class="img-fluid mb-4" style="max-width: 200px; max-height:200px; mix-blend-mode: darken;">
                        <h2 class="h4 mb-4">Your cart is empty!</h2>
                        <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
                        <a href="{{ route('product-list-categorized', 'all') }}" class="btn btn-primary">
                            <i class="fa-solid fa-shopping-cart me-2"></i>Start Shopping
                        </a>
                    </div>
                @endif
            </div>

            @if($cartItems->count() > 0)
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h4 mb-4">Order Summary</h2>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($subTotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Estimated Tax</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total Amount</span>
                            <span class="fw-bold fs-5">${{ number_format($total, 2) }}</span>
                        </div>
                        <form action="{{ route('cart.checkout') }}" method="post" onsubmit="return confirmCheckout()">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fa-solid fa-envelope me-1" aria-hidden="true"></i> Proceed to Checkout
                            </button>
                        </form>
                        <a class="btn btn-outline-secondary w-100" href="{{ route('product-list-categorized', 'all') }}">
                            <i class="fa-solid fa-arrow-left me-2"></i>Continue Shopping
                        </a>
                    </div>
                </div>
                <div class="mt-4 p-4 bg-light rounded">
                    <h3 class="h5 mb-3">Why Shop with Us?</h3>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-check text-success me-2"></i>Quality Aviation Products</li>
                        <li><i class="fa-solid fa-check text-success me-2"></i>Expert Customer Support</li>
                        <li><i class="fa-solid fa-check text-success me-2"></i>Fast & Secure Shipping</li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 

@push('styles')
<style>
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .card {
        transition: box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endpush

@push('scripts')
<script>
function confirmCheckout() {
    return confirm('Are you sure you want to submit this order? An email confirmation will be sent to your email address.');
}
</script>
@endpush