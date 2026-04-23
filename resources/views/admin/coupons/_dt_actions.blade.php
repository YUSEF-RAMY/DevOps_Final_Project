@php($c = $c ?? $coupon ?? null)
<div class="btn-group" role="group">
    <a href="{{ route('admin.coupons.edit', $c->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    <form action="{{ route('admin.coupons.toggle-status', $c->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-{{ $c->is_active ? 'warning' : 'success' }}" title="Toggle Status">
            <i class="bi bi-{{ $c->is_active ? 'pause' : 'play' }}"></i>
        </button>
    </form>
    <form action="{{ route('admin.coupons.destroy', $c->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>

