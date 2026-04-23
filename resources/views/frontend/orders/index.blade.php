@extends('frontend.layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h2 mb-0"><i class="bi bi-receipt me-2 text-primary"></i>My Orders</h1>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-bag me-1"></i>Continue Shopping</a>
    </div>

    @if($orders->count() === 0)
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>You haven't placed any orders yet.
            <a href="{{ route('products.index') }}" class="ms-2 btn btn-sm btn-primary">Start Shopping</a>
        </div>
    @else
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order #</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="fw-medium">{{ $order->number }}</td>
                                <td>
                                    <span class="badge rounded-pill {{ $order->status === 'pending' ? 'text-bg-warning' : ($order->status === 'delivered' ? 'text-bg-success' : ($order->status === 'cancelled' ? 'text-bg-danger' : 'text-bg-primary')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>@currency($order->grand_total)</td>
                                <td>@formatDate($order->created_at)</td>
                                <td class="text-end">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye me-1"></i>View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection


