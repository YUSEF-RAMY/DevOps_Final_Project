@extends('frontend.emails.layout')

@section('content')
    <h2>Order Status Update</h2>
    <p>Hello <strong>{{ $order->billing_name }}</strong>,</p>
    <p>We have an update on your order status.</p>
    
    <div class="info-box">
        <p><strong>Order Number:</strong> #{{ $order->number }}</p>
        <p><strong>New Status:</strong> <span class="status-badge status-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'warning' : 'info') }}" style="font-size: 16px; padding: 8px 16px;">{{ ucfirst($order->status) }}</span></p>
        @if(isset($message) && $message)
        <p style="margin-top: 15px; padding-top: 15px; border-top: 1px solid rgba(102, 126, 234, 0.2);"><strong>Message:</strong> {{ $message }}</p>
        @endif
    </div>

    <h3>Order Summary</h3>
    <table class="email-table">
        <tr>
            <td>Order Date</td>
            <td>@formatDate($order->created_at)</td>
        </tr>
        <tr>
            <td>Payment Status</td>
            <td><span class="status-badge status-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">{{ ucfirst($order->payment_status) }}</span></td>
        </tr>
        <tr>
            <td>Total Amount</td>
            <td style="color: #667eea; font-weight: 600; font-size: 18px;">{{ $currency ?? '৳' }}{{ number_format($order->grand_total, 2) }}</td>
        </tr>
    </table>

    <div style="text-align: center; margin: 35px 0;">
        <a href="{{ url('/orders/' . $order->id) }}" class="email-button">View Order Details</a>
    </div>

    <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef;">
        If you have any questions about your order status, please contact our support team. We're here to help!
    </p>
    <p style="margin-top: 15px;"><strong>Thank you for your patience!</strong></p>
@endsection
