@extends('admin.layouts.app')

@section('title', 'Wishlist Activity')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white border-bottom">
        <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-heart me-2"></i>Wishlist Activity</h3>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="wishlistsTable" class="table table-striped align-middle mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Product</th>
                        <th>Added At</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-person-x me-2"></i>Guest Wishlist Activity</h3>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="guestWishlistsTable" class="table table-striped align-middle mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Product</th>
                        <th>Session</th>
                        <th>Added At</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    initDataTableWithExport('#wishlistsTable', {
        processing: true,
        serverSide: true,
        ajax: { url: '{{ route('admin.datatables', 'wishlists') }}' },
        columns: [
            { data: 'user', name: 'user', orderable: true, searchable: false },
            { data: 'email', name: 'email', orderable: true, searchable: false },
            { data: 'phone', name: 'phone', orderable: true, searchable: false },
            { data: 'product', name: 'product', orderable: true, searchable: false },
            { data: 'created_at', name: 'created_at', orderable: true, searchable: false },
        ],
        order: [[4, 'desc']],
    }, 'Wishlist_Activity');

    initDataTableWithExport('#guestWishlistsTable', {
        processing: true,
        serverSide: true,
        ajax: { url: '{{ route('admin.datatables', 'guest-wishlists') }}' },
        columns: [
            { data: 'user', name: 'user', orderable: false, searchable: false },
            { data: 'email', name: 'email', orderable: false, searchable: false },
            { data: 'phone', name: 'phone', orderable: false, searchable: false },
            { data: 'product', name: 'product', orderable: true, searchable: false },
            { data: 'session', name: 'session', orderable: true, searchable: false },
            { data: 'created_at', name: 'created_at', orderable: true, searchable: false },
        ],
        order: [[5, 'desc']],
    }, 'Guest_Wishlist_Activity');
});
</script>
@endpush
@endsection


