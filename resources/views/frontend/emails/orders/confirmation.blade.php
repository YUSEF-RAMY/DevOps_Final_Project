@extends('frontend.emails.layout')

@section('content')
    <h2>Order Confirmation</h2>
    <p>Hello <strong>{{ $order->billing_name }}</strong>,</p>
    <p>Thank you for your order! We have received your order and are processing it. You'll receive another email when your order ships.</p>
    
    <div class="info-box">
        <p><strong>Order Number:</strong> #{{ $order->number }}</p>
        <p><strong>Order Date:</strong> @formatDate($order->created_at)</p>
        <p><strong>Order Status:</strong> <span class="status-badge status-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'warning' : 'info') }}">{{ ucfirst($order->status) }}</span></p>
        <p><strong>Payment Status:</strong> <span class="status-badge status-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">{{ ucfirst($order->payment_status) }}</span></p>
    </div>

    @if($order->items && $order->items->count() > 0)
    <h3>Order Items</h3>
    <table class="product-table">
        <thead>
            <tr>
                <th>Product</th>
                <th style="text-align: center;">Quantity</th>
                <th style="text-align: right;">Price</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>
                    <div class="product-name">{{ $item->product_name }}</div>
                    @if($item->product_sku)
                    <div class="product-sku">SKU: {{ $item->product_sku }}</div>
                    @endif
                </td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
                <td style="text-align: right;">{{ $currency ?? '৳' }}{{ number_format($item->unit_price, 2) }}</td>
                <td style="text-align: right; font-weight: 600;">{{ $currency ?? '৳' }}{{ number_format($item->line_total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <h3>Order Summary</h3>
    <table class="email-table">
        <tr>
            <td>Subtotal</td>
            <td style="text-align: right;">{{ $currency ?? '৳' }}{{ number_format($order->subtotal, 2) }}</td>
        </tr>
        @if($order->discount_total > 0)
        <tr>
            <td>Discount</td>
            <td style="text-align: right; color: #28a745; font-weight: 600;">- {{ $currency ?? '৳' }}{{ number_format($order->discount_total, 2) }}</td>
        </tr>
        @endif
        @if($order->shipping_total > 0)
        <tr>
            <td>Shipping</td>
            <td style="text-align: right;">{{ $currency ?? '৳' }}{{ number_format($order->shipping_total, 2) }}</td>
        </tr>
        @endif
        @if($order->tax_total > 0)
        <tr>
            <td>Tax</td>
            <td style="text-align: right;">{{ $currency ?? '৳' }}{{ number_format($order->tax_total, 2) }}</td>
        </tr>
        @endif
        <tr class="total-row">
            <td>Total</td>
            <td style="text-align: right; font-size: 20px;">{{ $currency ?? '৳' }}{{ number_format($order->grand_total, 2) }}</td>
        </tr>
    </table>

    <h3>Shipping Address</h3>
    <div class="info-box">
        <p><strong>{{ $order->billing_name }}</strong></p>
        <p>{{ $order->billing_address }}</p>
        <p>
            @if($order->billing_upazila){{ $order->billing_upazila }}, @endif
            @if($order->billing_district){{ $order->billing_district }}, @endif
            @if($order->billing_division){{ $order->billing_division }}@endif
            @if($order->billing_postcode) {{ $order->billing_postcode }}@endif
        </p>
        <p>{{ $order->billing_country }}</p>
        <p style="margin-top: 10px;"><strong>Phone:</strong> {{ $order->billing_phone }}</p>
        <p><strong>Email:</strong> {{ $order->billing_email }}</p>
    </div>

    @if($order->payment_method)
    <div class="info-box">
        <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
    </div>
    @endif

    <div style="text-align: center; margin: 35px 0;">
        <a href="{{ url('/orders/' . $order->id) }}" class="email-button">View Order Details</a>
    </div>

    <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef;">
        If you have any questions about your order, please don't hesitate to contact our support team. We're here to help!
    </p>
    <p style="margin-top: 15px;"><strong>Thank you for shopping with us!</strong></p>
@endsection
