@extends('frontend.layouts.app')

@section('title', 'Order ' . $order->number)

@section('content')
<div class="container py-5">
    <div class="mb-4 d-flex justify-content-between align-items-start flex-wrap gap-2">
        <div>
            <h1 class="h2 mb-1"><i class="bi bi-receipt-cutoff me-2 text-primary"></i>Order {{ $order->number }}</h1>
            <p class="text-muted mb-0">Placed on @formatDate($order->created_at)</p>
        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary" target="_blank" href="{{ route('orders.invoice', $order->id) }}"><i class="bi bi-file-earmark-text me-1"></i> Invoice</a>
            <a class="btn btn-primary" target="_blank" href="{{ route('orders.invoice', $order->id) }}?print=1"><i class="bi bi-printer me-1"></i> Print / PDF</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h2 class="h5 mb-0"><i class="bi bi-box-seam me-2"></i>Order Items</h2>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="fw-medium">{{ $item->product_name }}</td>
                                    <td class="text-muted">{{ $item->product_sku }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>@currency($item->unit_price)</td>
                                    <td class="fw-medium">@currency($item->line_total)</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h2 class="h6 mb-0"><i class="bi bi-clipboard-data me-2"></i>Order Summary</h2>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-medium">@currency($order->subtotal)</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tax</span>
                        <span class="fw-medium">@currency($order->tax_total)</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        <span class="fw-medium">@currency($order->shipping_total)</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold">@currency($order->grand_total)</span>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h2 class="h6 mb-0"><i class="bi bi-flag me-2"></i>Order Status</h2>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Order Status</span>
                        <span class="badge rounded-pill {{ $order->status === 'pending' ? 'text-bg-warning' : ($order->status === 'delivered' ? 'text-bg-success' : ($order->status === 'cancelled' ? 'text-bg-danger' : 'text-bg-primary')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Payment Status</span>
                        <span class="badge rounded-pill {{ $order->payment_status === 'paid' ? 'text-bg-success' : 'text-bg-danger' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Shipping Status</span>
                        <span class="badge rounded-pill {{ $order->shipping_status === 'delivered' ? 'text-bg-success' : 'text-bg-warning' }}">
                            {{ ucfirst($order->shipping_status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h2 class="h6 mb-0"><i class="bi bi-person-vcard me-2"></i>Billing Information</h2>
                </div>
                <div class="card-body">
                    @if($order->user)
                        <p class="fw-medium mb-0">{{ $order->user->name }}</p>
                        @if($order->user->email)
                            <p class="text-muted">{{ $order->user->email }}</p>
                        @endif
                    @else
                        <p class="fw-medium mb-0">{{ $order->billing_name }}</p>
                        <p class="text-muted">{{ $order->billing_email }}</p>
                    @endif
                    @if($order->billing_phone)
                        <p class="text-muted mb-0 mt-2">{{ $order->billing_phone }}</p>
                    @endif
                    @if($order->billing_address)
                        <div class="mt-3 small text-muted">
                            <p class="mb-0">{{ $order->billing_address }}</p>
                            <p class="mb-0">
                                @if($order->billing_upazila){{ $order->billing_upazila }}, @endif
                                @if($order->billing_district){{ $order->billing_district }}, @endif
                                @if($order->billing_division){{ $order->billing_division }}@endif
                                @if($order->billing_postcode) {{ $order->billing_postcode }}@endif
                            </p>
                            <p class="mb-0">{{ $order->billing_country }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


