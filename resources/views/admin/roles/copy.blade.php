@extends('admin.layouts.app')

@section('title', 'Copy Role')

@section('content')
<div class="card shadow-sm">
	<div class="card-header bg-white border-bottom">
		<div class="d-flex justify-content-between align-items-center">
			<h3 class="card-title mb-0 fw-semibold">Copy Role: {{ $role->name }}</h3>
			<a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm">
				<i class="bi bi-arrow-left me-1"></i>Back
			</a>
		</div>
	</div>
	<div class="card-body">
		<form action="{{ route('admin.roles.copy.store', $role) }}" method="post">
			@csrf
			<div class="mb-3">
				<label class="form-label fw-semibold">New Role Name</label>
				<input name="name" class="form-control" required placeholder="Enter new role name" value="{{ old('name', $role->name . ' Copy') }}" />
				@error('name')
					<div class="text-danger mt-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-3">
				<label class="form-label fw-semibold d-flex justify-content-between align-items-center">
					<span>Route Permissions (auto-from route names)</span>
					<span class="d-flex gap-2">
						<input id="routeFilter" type="text" class="form-control form-control-sm" placeholder="Filter..." style="width: 220px;">
						<button type="button" class="btn btn-sm btn-outline-secondary" id="routeSelectAll">Select All</button>
						<button type="button" class="btn btn-sm btn-outline-secondary" id="routeClearAll">Clear</button>
					</span>
				</label>
				<div id="routePermGrid" class="row" style="max-height:300px;overflow:auto;border:1px solid #e5e5e5;padding:8px;border-radius:4px;">
					@foreach($routeNames as $r)
						@php($checked = in_array($r, $assigned))
						@php($group = explode('.', $r)[1] ?? 'misc')
						<div class="col-md-4 route-item mb-2" data-name="{{ strtolower($r) }}" data-group="{{ $group }}">
							<label class="form-check">
								<input type="checkbox" class="form-check-input route-checkbox" name="permissions[]" value="{{ $r }}" @checked($checked) />
								<span class="form-check-label"><span class="badge bg-light text-dark me-1">{{ $group }}</span>{{ $r }}</span>
							</label>
						</div>
					@endforeach
				</div>
			</div>
			<div class="d-flex gap-2">
				<button type="submit" class="btn btn-primary">
					<i class="bi bi-check-circle me-1"></i>Create Copied Role
				</button>
				<a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
			</div>
		</form>
	</div>
</div>
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

