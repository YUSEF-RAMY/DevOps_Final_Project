@extends('admin.layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">All Users</h3>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <div class="filter-group">
                    <input type="date" id="u_from" class="form-control form-control-sm filter-input" placeholder="From Date" />
                </div>
                <div class="filter-group">
                    <input type="date" id="u_to" class="form-control form-control-sm filter-input" placeholder="To Date" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="usersTable" class="table table-bordered table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Addresses</th>
                        <th>Orders</th>
                        <th>Joined</th>
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
    const table = initDataTableWithExport('#usersTable', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.datatables', 'users') }}',
            data: function(d){
                d.from = document.getElementById('u_from').value || '';
                d.to = document.getElementById('u_to').value || '';
            }
        },
        order: [[0,'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'addresses_count', name: 'addresses_count', orderable: true, searchable: false, className: 'text-center' },
            { data: 'orders_count', name: 'orders_count', orderable: true, searchable: false, className: 'text-center' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, exportable: false }
        ]
    }, 'Users');
    ['u_from','u_to'].forEach(id => document.getElementById(id).addEventListener('change', ()=>table.ajax.reload()));
});
</script>
@endpush
@endsection
