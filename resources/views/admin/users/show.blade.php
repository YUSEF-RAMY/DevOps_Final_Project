@extends('admin.layouts.app')

@section('page_title', 'User #' . $user->id)

@section('content')
<div class="row">
    <div class="col-md-6">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Profile</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                </div>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Name</dt><dd class="col-sm-8">{{ $user->name }}</dd>
                    <dt class="col-sm-4">Email</dt><dd class="col-sm-8">{{ $user->email ?? '—' }}</dd>
                    <dt class="col-sm-4">Phone</dt><dd class="col-sm-8">{{ $user->phone ?? '—' }}</dd>
                    <dt class="col-sm-4">Joined</dt><dd class="col-sm-8">@formatDate($user->created_at)</dd>
                        <dt class="col-sm-4">Coins</dt><dd class="col-sm-8"><span class="badge text-bg-success">{{ $user->coins_balance ?? 0 }}</span></dd>
                </dl>
                <form action="{{ route('admin.users.reset-password', $user) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-secondary" onclick="event.preventDefault(); Swal.fire({icon: 'warning', title: 'Reset Password?', text: 'Reset password to \"password\"?', showCancelButton: true, confirmButtonColor: '#dc3545', cancelButtonColor: '#6c757d', confirmButtonText: 'Yes, Reset', cancelButtonText: 'Cancel'}).then((result) => { if (result.isConfirmed) { this.closest('form').submit(); } }); return false;">
                        <i class="fas fa-key"></i> Reset Password
                    </button>
                </form>
                @if($user->email !== 'admin@example.com')
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
                @endif
            </div>
        </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Adjust Coins</h3></div>
                <div class="card-body">
                    <form action="{{ route('admin.users.coins.adjust', $user) }}" method="post" class="row g-2">
                        @csrf
                        <div class="col-md-3">
                            <label class="form-label">Amount (+/-)</label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Reason</label>
                            <input type="text" name="reason" class="form-control" placeholder="e.g., bonus, correction">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary w-100"><i class="bi bi-coin"></i> Apply</button>
                        </div>
                    </form>
                    <form action="{{ route('admin.users.coins.reset', $user) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger" onclick="event.preventDefault(); Swal.fire({icon: 'warning', title: 'Reset Coins?', text: 'Reset coins to 0?', showCancelButton: true, confirmButtonColor: '#dc3545', cancelButtonColor: '#6c757d', confirmButtonText: 'Yes, Reset', cancelButtonText: 'Cancel'}).then((result) => { if (result.isConfirmed) { this.closest('form').submit(); } }); return false;">Reset Coins</button>
                    </form>
                </div>
            </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Addresses ({{ $user->addresses->count() }})</h3></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead><tr><th>Type</th><th>Name</th><th>Address</th><th>Phone</th></tr></thead>
                        <tbody>
                        @forelse($user->addresses as $addr)
                            <tr>
                                <td>{{ ucfirst($addr->type) }} @if($addr->is_default)<span class="badge text-bg-primary">Default</span>@endif</td>
                                <td>{{ $addr->full_name }}</td>
                                <td>{{ $addr->full_address }}</td>
                                <td>{{ $addr->phone ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">No addresses</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Orders ({{ $user->orders->count() }})</h3></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead><tr><th>#</th><th>Status</th><th>Total</th><th>Date</th><th></th></tr></thead>
                        <tbody>
                        @forelse($user->orders as $order)
                            <tr>
                                <td>{{ $order->number }}</td>
                                <td><span class="badge text-bg-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'pending' ? 'warning text-dark' : 'secondary') }}">{{ ucfirst($order->status) }}</span></td>
                                <td>@currency($order->grand_total)</td>
                                <td>@formatDate($order->created_at)</td>
                                <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-primary">View</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No orders</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header"><h3 class="card-title">Wishlist ({{ $wishlists->count() }})</h3></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead><tr><th>Product</th><th>Added</th></tr></thead>
                        <tbody>
                        @forelse($wishlists as $w)
                            <tr>
                                <td>
                                    @if($w->product)
                                        <a href="{{ route('products.show', $w->product->slug) }}" target="_blank">{{ $w->product->name }}</a>
                                    @else
                                        <span class="text-muted">(deleted product)</span>
                                    @endif
                                </td>
                                <td>@formatDate($w->created_at)</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center text-muted py-3">No wishlist items</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header"><h3 class="card-title">Recent Cart Items ({{ $cartItems->count() }})</h3></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead><tr><th>Product</th><th>Qty</th><th>Added</th></tr></thead>
                        <tbody>
                        @forelse($cartItems as $ci)
                            <tr>
                                <td>
                                    @if($ci->product)
                                        <a href="{{ route('products.show', $ci->product->slug) }}" target="_blank">{{ $ci->product->name }}</a>
                                    @else
                                        <span class="text-muted">(deleted product)</span>
                                    @endif
                                </td>
                                <td>{{ (int) $ci->quantity }}</td>
                                <td>@formatDate($ci->created_at)</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-3">No recent cart items</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Login Sessions ({{ $sessions->count() }})</h3>
                <form action="{{ route('admin.activities.sessions.destroy-user', $user) }}" method="post" onsubmit="return confirm('Destroy all sessions for this user?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-x-circle"></i> Destroy All</button>
                </form>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead><tr><th>IP</th><th>User Agent</th><th>Last Activity</th><th>Session</th></tr></thead>
                        <tbody>
                        @forelse($sessions as $s)
                            <tr>
                                <td><code>{{ $s->ip_address ?? '—' }}</code></td>
                                <td class="small" title="{{ $s->user_agent }}">{{ Str::limit($s->user_agent, 60) }}</td>
                                <td>{{ \Carbon\Carbon::createFromTimestamp($s->last_activity)->format('Y-m-d H:i') }}</td>
                                <td class="small"><code>{{ $s->id }}</code></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">No sessions</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


