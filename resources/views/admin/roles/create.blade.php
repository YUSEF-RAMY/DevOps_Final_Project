@extends('admin.layouts.app')

@section('title', 'New Role')

@section('content')
<h1 class="h4 mb-3">New Role</h1>
<form action="{{ route('admin.roles.store') }}" method="post">
	@csrf
	<div class="mb-3">
		<label class="form-label">Name</label>
		<input name="name" class="form-control" required />
	</div>
	<div class="mb-3">
		<label class="form-label d-flex justify-content-between align-items-center">
			<span>Route Permissions (auto-from route names)</span>
			<span class="d-flex gap-2">
				<input id="routeFilter" type="text" class="form-control form-control-sm" placeholder="Filter..." style="width: 220px;">
				<button type="button" class="btn btn-sm btn-outline-secondary" id="routeSelectAll">Select All</button>
				<button type="button" class="btn btn-sm btn-outline-secondary" id="routeClearAll">Clear</button>
			</span>
		</label>
		<div id="routePermGrid" class="row" style="max-height:300px;overflow:auto;border:1px solid #e5e5e5;padding:8px;border-radius:4px;">
			@foreach($routeNames as $r)
				@php($group = explode('.', $r)[1] ?? 'misc')
				<div class="col-md-4 route-item" data-name="{{ strtolower($r) }}" data-group="{{ $group }}">
					<label class="form-check">
						<input type="checkbox" class="form-check-input route-checkbox" name="permissions[]" value="{{ $r }}" />
						<span class="form-check-label"><span class="badge bg-light text-dark me-1">{{ $group }}</span>{{ $r }}</span>
					</label>
				</div>
			@endforeach
		</div>
	</div>
	<button class="btn btn-primary">Create</button>
</form>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
  const grid = document.getElementById('routePermGrid');
  const filter = document.getElementById('routeFilter');
  const selectAll = document.getElementById('routeSelectAll');
  const clearAll = document.getElementById('routeClearAll');
  if(!grid) return;
  const items = grid.querySelectorAll('.route-item');
  filter?.addEventListener('input', function(){
    const q = this.value.toLowerCase().trim();
    items.forEach(it => {
      const visible = !q || it.dataset.name.includes(q) || it.dataset.group.includes(q);
      it.style.display = visible ? '' : 'none';
    });
  });
  selectAll?.addEventListener('click', function(){
    grid.querySelectorAll('.route-item:not([style*="display: none"]) .route-checkbox').forEach(cb => cb.checked = true);
  });
  clearAll?.addEventListener('click', function(){
    grid.querySelectorAll('.route-item:not([style*="display: none"]) .route-checkbox').forEach(cb => cb.checked = false);
  });
});
</script>
@endpush


