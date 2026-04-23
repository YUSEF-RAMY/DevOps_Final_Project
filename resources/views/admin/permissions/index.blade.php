@extends('admin.layouts.app')

@section('title', 'Permissions')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">Permissions</h3>
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i>New Permission
            </a>
        </div>
    </div>
    <div class="card-body p-3">
    <div class="table-responsive">
      <table id="permissionsTable" class="table table-bordered mb-0" style="width:100%">
        <thead>
          <tr><th>Name</th><th>Actions</th></tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
  initDataTableWithExport('#permissionsTable', {
    processing: true,
    serverSide: true,
    ajax: { url: '{{ route('admin.datatables', 'permissions') }}' },
    columns: [
      { data: 'name', name: 'name' },
      { data: 'actions', name: 'actions', orderable: false, searchable: false, exportable: false }
    ]
  }, 'Permissions');
});
</script>
@endpush
@endsection


