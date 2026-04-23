@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">Categories</h3>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <div class="filter-group">
                    <select id="filter_cat_active" class="form-select form-select-sm filter-select">
                        <option value="">All Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>New Category
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="categoriesTable" class="table table-striped mb-0 align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Active</th>
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
    const table = initDataTableWithExport('#categoriesTable', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.datatables', 'categories') }}',
            data: function(d){
                d.is_active = document.getElementById('filter_cat_active').value || '';
            }
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'parent', name: 'parent', className: 'text-center', orderable: false, searchable: false },
            { data: 'is_active', name: 'is_active', className: 'text-center', orderable: true, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center', exportable: false },
        ],
        order: [[0, 'asc']],
    }, 'Categories');
    document.getElementById('filter_cat_active').addEventListener('change', ()=>table.ajax.reload());
});
</script>
@endpush
@endsection


