@extends('admin.layouts.app')

@section('title', 'Currencies')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">Currencies</h3>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <a href="{{ route('admin.currencies.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>New Currency
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="d-flex gap-2 align-items-center mb-3">
            <div class="filter-group">
                <select id="f_curr_active" class="form-select form-select-sm filter-select">
                    <option value="">All Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <div class="table-responsive">
            <table id="currenciesTable" class="table table-bordered table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Symbol</th>
                        <th>Status</th>
                        <th>Default</th>
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
  const table = initDataTableWithExport('#currenciesTable', {
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ route('admin.datatables', 'currencies') }}',
      data: function(d){ d.is_active = document.getElementById('f_curr_active').value || ''; }
    },
    order: [[1,'asc']],
    columns: [
      { data: 'code', name: 'code' },
      { data: 'name', name: 'name' },
      { data: 'symbol', name: 'symbol' },
      { data: 'is_active', name: 'is_active', searchable: false },
      { data: 'is_default', name: 'is_default', searchable: false },
      { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center', exportable: false }
    ]
  }, 'Currencies');
  document.getElementById('f_curr_active').addEventListener('change', ()=>table.ajax.reload());
});
</script>
@endpush
@endsection
