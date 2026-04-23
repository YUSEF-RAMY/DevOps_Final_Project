@php($a = $a ?? $admin ?? null)
<div class="btn-group" role="group">
    <a href="{{ route('admin.admins.edit', $a) }}" class="btn btn-sm btn-outline-primary" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    @if($a->email !== 'admin@example.com')
    <form action="{{ route('admin.admins.destroy', $a) }}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-outline-danger" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </form>
    @endif
</div>

