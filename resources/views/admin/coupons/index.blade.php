@extends('admin.layouts.app')

@section('title', 'Coupons')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">Coupons</h3>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <div class="filter-group">
                    <select id="f_coupon_type" class="form-select form-select-sm filter-select">
                        <option value="">All Types</option>
                        <option value="percentage">Percentage</option>
                        <option value="fixed">Fixed</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select id="f_coupon_active" class="form-select form-select-sm filter-select">
                        <option value="">All Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>New Coupon
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="couponsTable" class="table table-bordered table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Usage</th>
                        <th>Status</th>
                        <th>Expires</th>
                        <th>Actions</th>
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
    const table = initDataTableWithExport('#couponsTable', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.datatables', 'coupons') }}',
            data: function(d){
                d.type = document.getElementById('f_coupon_type').value || '';
                d.is_active = document.getElementById('f_coupon_active').value || '';
            }
        },
        order: [[6,'desc']],
        columns: [
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name' },
            { data: 'type', name: 'type', searchable: false },
            { data: 'value', name: 'value', searchable: false },
            { data: 'usages_count', name: 'usages_count', searchable: false, className: 'text-center' },
            { data: 'is_active', name: 'is_active', searchable: false },
            { data: 'expires_at', name: 'expires_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center', exportable: false },
        ]
    }, 'Coupons');
    ['f_coupon_type','f_coupon_active'].forEach(id => document.getElementById(id).addEventListener('change', ()=>table.ajax.reload()));
});
</script>
@endpush
@endsection
