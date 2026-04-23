@php($p = $p ?? $page ?? null)
<div class="btn-group" role="group">
    <a href="{{ route('admin.pages.edit', $p) }}" class="btn btn-sm btn-outline-primary" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    <form action="{{ route('admin.pages.destroy', $p) }}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-outline-danger" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>

