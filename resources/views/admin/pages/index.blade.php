@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">Pages</h3>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <div class="filter-group">
                    <select id="filter_page_active" class="form-select form-select-sm filter-select">
                        <option value="">All Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>New Page
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="pagesTable" class="table table-striped mb-0 align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Sort Order</th>
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
    const table = initDataTableWithExport('#pagesTable', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.datatables', 'pages') }}',
            data: function(d){
                d.is_active = document.getElementById('filter_page_active').value || '';
            }
        },
        columns: [
            { data: 'title', name: 'title' },
            { data: 'slug', name: 'slug', className: 'text-center' },
            { data: 'is_active', name: 'is_active', className: 'text-center', orderable: true, searchable: false },
            { data: 'sort_order', name: 'sort_order', className: 'text-center', orderable: true, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center', exportable: false },
        ],
        order: [[3, 'asc']],
    }, 'Pages');
    document.getElementById('filter_page_active').addEventListener('change', ()=>table.ajax.reload());
});
</script>
@endpush
@endsection

