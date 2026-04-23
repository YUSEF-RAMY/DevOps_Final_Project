@extends('admin.layouts.app')

@section('title', 'Roles')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">Roles</h3>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i>New Role
            </a>
        </div>
    </div>
    <div class="card-body p-3">
    <div class="table-responsive">
      <table id="rolesTable" class="table table-bordered mb-0" style="width:100%">
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
  initDataTableWithExport('#rolesTable', {
    processing: true,
    serverSide: true,
    ajax: { url: '{{ route('admin.datatables', 'roles') }}' },
    columns: [
      { data: 'name', name: 'name' },
      { data: 'actions', name: 'actions', orderable: false, searchable: false, exportable: false }
    ]
  }, 'Roles');
});
</script>
@endpush
@endsection


