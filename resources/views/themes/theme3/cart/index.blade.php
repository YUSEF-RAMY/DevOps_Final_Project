@extends('themes.theme3.layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<!-- Page Header -->
<section class="bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Cart Section -->
<section class="py-5">
    <div class="container">
        <h2 class="mb-4 fw-bold">Shopping Cart</h2>
        <div class="row">
            <div class="col-lg-8">
                @if(empty($cart) || $cart->items->isEmpty())
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Your cart is empty</h4>
                            <p class="text-muted">Add some products to your cart to continue shopping.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
                        </div>
                    </div>
                @else
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($availableItems ?? [] as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->product && $item->product->images->count() > 0)
                                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                            <i class="fas fa-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">
                                                            @if($item->product)
                                                                <a href="{{ route('products.show', $item->product->slug) }}" class="text-decoration-none text-dark">{{ $item->product->name }}</a>
                                                            @else
                                                                Product Unavailable
                                                            @endif
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($item->product)
                                                <form action="{{ route('cart.items.update', $item->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="input-group" style="width: 120px;">
                                                        <input type="number" name="quantity" class="form-control text-center" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" onchange="this.form.submit()">
                                                    </div>
                                                </form>
                                                @else
                                                    <span class="text-muted">{{ $item->quantity }}</span>
                                                @endif
                                            </td>
                                            <td>@currency($item->unit_price ?? 0)</td>
                                            <td>@currency($item->line_total ?? 0)</td>
                                            <td>
                                                <form action="{{ route('cart.items.remove', $item->id) }}" method="post" onsubmit="return confirm('Remove this item?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-4 fw-bold">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>@currency($cart->subtotal ?? 0)</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax:</span>
                            <span>@currency($cart->tax_total ?? 0)</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total:</strong>
                            <strong class="text-primary">@currency($cart->grand_total ?? 0)</strong>
                        </div>
                        @if(!empty($cart) && $cart->items->isNotEmpty())
                            <a href="{{ route('checkout.show') }}" class="btn btn-primary w-100 btn-lg mb-3">
                                <i class="fas fa-lock me-2"></i>Proceed to Checkout
                            </a>
                        @endif
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

