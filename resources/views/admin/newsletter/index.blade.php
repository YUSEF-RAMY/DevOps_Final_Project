@extends('admin.layouts.app')

@section('title', 'Newsletter')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">Newsletter Subscribers</h3>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <div class="filter-group">
                    <select id="f_sub_status" class="form-select form-select-sm filter-select">
                        <option value="">All Status</option>
                        <option value="subscribed">Subscribed</option>
                        <option value="unsubscribed">Unsubscribed</option>
                    </select>
                </div>
                <a href="{{ route('admin.site-settings.index') }}#newsletter-settings" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-gear me-1"></i>Newsletter Settings
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="subsTable" class="table table-hover mb-0" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Source</th>
                        <th>Subscribed</th>
                        <th class="text-end">Actions</th>
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
  const table = initDataTableWithExport('#subsTable', {
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ route('admin.datatables', 'newsletter') }}',
      data: function(d){ d.status = document.getElementById('f_sub_status').value || ''; }
    },
    columns: [
      { data: 'email', name: 'email' },
      { data: 'name', name: 'name' },
      { data: 'status', name: 'status', searchable: false },
      { data: 'source', name: 'source', searchable: false },
      { data: 'subscribed_at', name: 'subscribed_at' },
      { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-end', exportable: false },
    ]
  }, 'Newsletter_Subscribers');
  document.getElementById('f_sub_status').addEventListener('change', ()=>table.ajax.reload());
});
</script>
@endpush
@endsection
