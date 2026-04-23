@extends('admin.layouts.app')

@section('breadcrumbs')
<div class="content-header mb-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Order {{ $order->number }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order {{ $order->number }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Items</h3>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <div></div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="btn btn-sm btn-primary"><i class="bi bi-file-earmark-text me-1"></i> Invoice</a>
                    <a href="{{ route('admin.orders.invoice', $order) }}?print=1" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="bi bi-printer me-1"></i> Print / PDF</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
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
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->product_sku }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>@currency($item->unit_price)</td>
                                    <td>@currency($item->line_total)</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Summary</h3>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-6"><strong>Subtotal:</strong></div>
                    <div class="col-6 text-right">@currency($order->subtotal)</div>
                </div>
                @if((float)$order->discount_total > 0)
                <div class="row mb-2">
                    <div class="col-6"><strong>Discount:</strong></div>
                    <div class="col-6 text-right">-@currency($order->discount_total)</div>
                </div>
                @endif
                <div class="row mb-2">
                    <div class="col-6"><strong>Tax:</strong></div>
                    <div class="col-6 text-right">@currency($order->tax_total)</div>
                </div>
                <div class="row mb-2">
                    <div class="col-6"><strong>Shipping:</strong></div>
                    <div class="col-6 text-right">@currency($order->shipping_total)</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6"><strong>Total:</strong></div>
                    <div class="col-6 text-right"><strong>@currency($order->grand_total)</strong></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Order Status</h3>
            </div>
            <form action="{{ route('admin.orders.update', $order) }}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Order Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Status</label>
                        <select name="payment_status" class="form-control">
                            <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Shipping Status</label>
                        <select name="shipping_status" class="form-control">
                            <option value="unshipped" {{ $order->shipping_status === 'unshipped' ? 'selected' : '' }}>Unshipped</option>
                            <option value="shipped" {{ $order->shipping_status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->shipping_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Order</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Customer Information</h3>
            </div>
            <div class="card-body">
                @if($order->user)
                    <p><strong>Name:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                @else
                    <p><strong>Name:</strong> {{ $order->billing_name }}</p>
                    <p><strong>Email:</strong> {{ $order->billing_email }}</p>
                @endif
                
                @if($order->billing_phone)
                    <p><strong>Phone:</strong> {{ $order->billing_phone }}</p>
                @endif
                
                @if($order->billing_address)
                    <p><strong>Address:</strong><br>
                    {{ $order->billing_address }}<br>
                    @if($order->billing_upazila){{ $order->billing_upazila }}, @endif
                    @if($order->billing_district){{ $order->billing_district }}, @endif
                    @if($order->billing_division){{ $order->billing_division }}@endif
                    @if($order->billing_postcode) {{ $order->billing_postcode }}@endif<br>
                    {{ $order->billing_country }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
