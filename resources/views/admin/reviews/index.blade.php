@extends('admin.layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">Product Reviews</h3>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <div class="filter-group">
                    <select id="filter_review_status" class="form-select form-select-sm filter-select">
                        <option value="">All Reviews</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="reviewsTable" class="table table-hover mb-0 align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="width:160px">Actions</th>
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
    const table = initDataTableWithExport('#reviewsTable', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.datatables', 'reviews') }}',
            data: function(d){
                d.status = document.getElementById('filter_review_status')?.value || '';
            }
        },
        columns: [
            { data: 'product', name: 'product', orderable: true, searchable: false },
            { data: 'user', name: 'user', orderable: true, searchable: false },
            { data: 'rating', name: 'rating', orderable: true, searchable: false, className: 'text-center' },
            { data: 'review', name: 'review', orderable: true, searchable: false },
            { data: 'status', name: 'status', orderable: true, searchable: false, className: 'text-center' },
            { data: 'created_at', name: 'created_at', orderable: true, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center', exportable: false },
        ],
        order: [[5, 'desc']],
    }, 'Reviews');
    
    const statusSelect = document.getElementById('filter_review_status');
    if (statusSelect) {
        statusSelect.addEventListener('change', () => table.ajax.reload());
    }
});
</script>
@endpush
@endsection

