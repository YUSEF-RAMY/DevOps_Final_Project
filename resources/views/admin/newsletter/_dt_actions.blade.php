@php($s = $s ?? $subscriber ?? null)
<div class="btn-group" role="group">
    <form action="{{ route('admin.newsletter.toggle', $s) }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-sm btn-outline-warning" type="submit" title="Toggle Status">
            <i class="bi bi-toggle2-on"></i>
        </button>
    </form>
    <form action="{{ route('admin.newsletter.destroy', $s) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-outline-danger" type="submit" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>

