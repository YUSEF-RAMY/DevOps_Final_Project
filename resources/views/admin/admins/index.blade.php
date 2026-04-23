@extends('admin.layouts.app')

@section('title', 'Administrators')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">Administrators</h3>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>New Admin
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
    <div class="table-responsive">
            <table id="adminsTable" class="table table-bordered table-striped align-middle" style="width:100%">
        <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Roles</th><th></th></tr></thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
  initDataTableWithExport('#adminsTable', {
    processing: true,
    serverSide: true,
    ajax: { url: '{{ route('admin.datatables', 'admins') }}' },
    order: [[0,'desc']],
    columns: [
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      { data: 'email', name: 'email' },
      { data: 'roles', name: 'roles', orderable: false, searchable: false },
      { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center', exportable: false }
    ]
  }, 'Administrators');
});
</script>
@endpush
@endsection


