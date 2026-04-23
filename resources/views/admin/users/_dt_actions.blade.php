@php($u = $u ?? $user ?? null)
<div class="btn-group" role="group">
    <a href="{{ route('admin.users.show', $u) }}" class="btn btn-sm btn-outline-info" title="View">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-primary" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    @if($u->email !== 'admin@example.com')
    <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </form>
    @endif
</div>

