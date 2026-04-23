@php($c = $c ?? $category ?? null)
<div class="btn-group" role="group">
    <a href="{{ route('admin.categories.edit', $c) }}" class="btn btn-sm btn-outline-primary" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    <form action="{{ route('admin.categories.destroy', $c) }}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-outline-danger" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>

