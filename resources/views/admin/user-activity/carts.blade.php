@extends('admin.layouts.app')

@section('title', 'Cart Activity')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-cart-plus me-2"></i>Cart Activity</h3>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="cartsTable" class="table table-striped align-middle mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Product</th>
                        <th>Quantity</th>
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
    initDataTableWithExport('#cartsTable', {
        processing: true,
        serverSide: true,
        ajax: { url: '{{ route('admin.datatables', 'carts') }}' },
        columns: [
            { data: 'user', name: 'user', orderable: true, searchable: false },
            { data: 'email', name: 'email', orderable: true, searchable: false },
            { data: 'phone', name: 'phone', orderable: true, searchable: false },
            { data: 'product', name: 'product', orderable: true, searchable: false },
            { data: 'quantity', name: 'quantity', orderable: true, searchable: false, className: 'text-center' },
            { data: 'created_at', name: 'created_at', orderable: true, searchable: false },
        ],
        order: [[5, 'desc']],
    }, 'Cart_Activity');
});
</script>
@endpush
@endsection


