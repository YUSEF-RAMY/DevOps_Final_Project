@php($r = $r ?? $role ?? null)
<div class="btn-group" role="group">
	<a href="{{ route('admin.roles.edit', $r) }}" class="btn btn-sm btn-outline-primary" title="Edit">
		<i class="bi bi-pencil"></i>
	</a>
	<a href="{{ route('admin.roles.copy', $r) }}" class="btn btn-sm btn-outline-info" title="Copy Role">
		<i class="bi bi-copy"></i>
	</a>
	<form action="{{ route('admin.roles.destroy', $r) }}" method="post" class="d-inline">
		@csrf
		@method('DELETE')
		<button class="btn btn-sm btn-outline-danger" title="Delete">
			<i class="bi bi-trash"></i>
		</button>
	</form>
</div>

