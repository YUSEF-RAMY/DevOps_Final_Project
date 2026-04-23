@php($c = $c ?? $currency ?? null)
<div class="btn-group" role="group">
    <a href="{{ route('admin.currencies.edit', $c) }}" class="btn btn-sm btn-outline-primary" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    <form action="{{ route('admin.currencies.toggle', $c) }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-sm btn-outline-{{ $c->is_active ? 'warning' : 'success' }}" type="submit" title="Toggle Status">
            <i class="bi bi-{{ $c->is_active ? 'pause' : 'play' }}"></i>
        </button>
    </form>
    @if(!$c->is_default)
    <form action="{{ route('admin.currencies.default', $c) }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-sm btn-outline-info" type="submit" title="Set Default">
            <i class="bi bi-star"></i>
        </button>
    </form>
    @endif
    <form action="{{ route('admin.currencies.destroy', $c) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-outline-danger" type="submit" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>

