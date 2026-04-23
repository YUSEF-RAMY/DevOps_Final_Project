@extends('admin.layouts.app')

@section('title', 'Error Logs')

@push('styles')
<style>
.btn-action { padding: 0.45rem 0.9rem; font-size: 0.95rem; border-radius: 0.4rem; }
.btn-action-table { padding: 0.25rem 0.6rem; font-size: 0.85rem; border-radius: 0.35rem; }
.severity-critical { border-left: 4px solid #dc3545; }
.severity-high { border-left: 4px solid #fd7e14; }
.severity-medium { border-left: 4px solid #ffc107; }
.severity-low { border-left: 4px solid #0dcaf0; }
</style>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible py-2 mb-3">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-secondary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i>Error Logs</h3>
                        <p class="mb-0 mt-1 small opacity-75">Monitor and manage application errors</p>
                    </div>
                    <form action="{{ route('admin.error-logs.clear-resolved') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to clear all resolved errors?');">
                        @csrf
                        <button type="submit" class="btn btn-light btn-action shadow-sm">
                            <i class="bi bi-trash me-1"></i>Clear Resolved
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1 small text-uppercase">Total Errors</h6>
                                <h3 class="mb-0 fw-bold">{{ $total }}</h3>
                            </div>
                            <i class="bi bi-bug fs-1 text-secondary opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 severity-critical">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1 small text-uppercase">Critical</h6>
                                <h3 class="mb-0 fw-bold text-danger">{{ $critical }}</h3>
                            </div>
                            <i class="bi bi-exclamation-octagon fs-1 text-danger opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 severity-high">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1 small text-uppercase">Unresolved</h6>
                                <h3 class="mb-0 fw-bold text-warning">{{ $unresolved }}</h3>
                            </div>
                            <i class="bi bi-exclamation-circle fs-1 text-warning opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1 small text-uppercase">Today</h6>
                                <h3 class="mb-0 fw-bold">{{ $today }}</h3>
                            </div>
                            <i class="bi bi-calendar-day fs-1 text-info opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.error-logs.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="severity" class="form-label">Severity</label>
                        <select name="severity" id="severity" class="form-select">
                            <option value="">All Severities</option>
                            <option value="critical" {{ request('severity') == 'critical' ? 'selected' : '' }}>Critical</option>
                            <option value="high" {{ request('severity') == 'high' ? 'selected' : '' }}>High</option>
                            <option value="medium" {{ request('severity') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="low" {{ request('severity') == 'low' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="resolved" class="form-label">Status</label>
                        <select name="resolved" id="resolved" class="form-select">
                            <option value="">All</option>
                            <option value="0" {{ request('resolved') === '0' ? 'selected' : '' }}>Unresolved</option>
                            <option value="1" {{ request('resolved') === '1' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search message, route, file..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-action w-100">
                            <i class="bi bi-search me-1"></i>Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="3%"><input type="checkbox" id="selectAll"></th>
                                <th width="5%">ID</th>
                                <th width="10%">Severity</th>
                                <th width="25%">Message</th>
                                <th width="15%">Route</th>
                                <th width="10%">File</th>
                                <th width="5%">Occurrences</th>
                                <th width="12%">Date</th>
                                <th width="5%">Status</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                @php $sev = \App\Models\ErrorLog::severityFromType($log->type); @endphp
                                <tr>
                                    <td><input type="checkbox" class="log-checkbox" name="ids[]" value="{{ $log->id }}"></td>
                                    <td>{{ $log->id }}</td>
                                    <td><span class="badge bg-{{ $sev == 'critical' ? 'danger' : ($sev == 'high' ? 'warning' : ($sev == 'medium' ? 'info' : 'secondary')) }}">{{ ucfirst($sev) }}</span></td>
                                    <td class="small">{{ Str::limit($log->message, 60) }}</td>
                                    <td class="small text-truncate" style="max-width:150px" title="{{ $log->url }}">{{ Str::limit($log->url, 25) ?: '-' }}</td>
                                    <td class="small text-truncate" style="max-width:120px" title="{{ $log->file }}">{{ $log->file ? Str::limit(basename($log->file), 15) . ':' . $log->line : '-' }}</td>
                                    <td>1</td>
                                    <td class="small">{{ $log->created_at->format('M d, H:i') }}</td>
                                    <td>
                                        @if($log->is_resolved)
                                            <span class="badge bg-success">Resolved</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Unresolved</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.error-logs.show', $log) }}" class="btn btn-sm btn-primary btn-action-table">View</a>
                                        <form action="{{ route('admin.error-logs.destroy', $log) }}" method="post" class="d-inline" onsubmit="return confirm('Delete?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger btn-action-table">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-5">
                                        <i class="bi bi-check-circle fs-2 mb-3 d-block"></i>
                                        No errors found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <form id="bulkResolveForm" action="{{ route('admin.error-logs.mark-resolved') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="ids" id="bulkResolveIds">
                    <button type="submit" class="btn btn-sm btn-success" id="bulkResolveBtn" disabled>
                        <i class="bi bi-check-all me-1"></i>Mark Selected as Resolved
                    </button>
                </form>
            </div>
        </div>

        @if($logs->hasPages())
            <div class="mt-3">{{ $logs->links() }}</div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    var selectAll = document.getElementById('selectAll');
    var checkboxes = document.querySelectorAll('.log-checkbox');
    var bulkBtn = document.getElementById('bulkResolveBtn');
    var bulkIds = document.getElementById('bulkResolveIds');
    var form = document.getElementById('bulkResolveForm');
    function updateBulk(){
        var ids = [];
        checkboxes.forEach(function(cb){ if(cb.checked) ids.push(cb.value); });
        bulkIds.value = ids.join(',');
        bulkBtn.disabled = ids.length === 0;
    }
    if (selectAll) selectAll.addEventListener('change', function(){ checkboxes.forEach(function(cb){ cb.checked = selectAll.checked; }); updateBulk(); });
    checkboxes.forEach(function(cb){ cb.addEventListener('change', updateBulk); });
});
</script>
@endpush
@endsection
