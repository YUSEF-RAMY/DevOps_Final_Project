@extends('admin.layouts.app')

@section('content')
<style>
    .btn-action {
        padding: 0.45rem 0.9rem;
        font-size: 0.95rem;
        border-radius: 0.4rem;
    }
    .code-block {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 15px;
        font-family: 'Courier New', monospace;
        font-size: 12px;
        max-height: 400px;
        overflow-y: auto;
        white-space: pre-wrap;
        word-break: break-all;
    }
</style>

<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i>Error Details</h3>
                    <p class="mb-0 mt-1 small opacity-75">Detailed information about this error</p>
                </div>
                <a href="{{ route('admin.error-logs.index') }}" class="btn btn-light btn-action shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i>Back to List
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                <!-- Basic Information -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Basic Information</h5>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Severity</dt>
                                <dd class="col-sm-9">
                                    @if($errorLog->severity == 'critical')
                                        <span class="badge bg-danger fs-6">Critical</span>
                                    @elseif($errorLog->severity == 'high')
                                        <span class="badge bg-warning text-dark fs-6">High</span>
                                    @elseif($errorLog->severity == 'medium')
                                        <span class="badge bg-info fs-6">Medium</span>
                                    @else
                                        <span class="badge bg-secondary fs-6">Low</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-3">Status</dt>
                                <dd class="col-sm-9">
                                    @if($errorLog->is_resolved)
                                        <span class="badge bg-success">Resolved</span>
                                        <small class="text-muted ms-2">on {{ $errorLog->resolved_at->format('Y-m-d H:i:s') }}</small>
                                    @else
                                        <span class="badge bg-warning">Active</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-3">Exception Type</dt>
                                <dd class="col-sm-9"><code>{{ $errorLog->exception }}</code></dd>

                                <dt class="col-sm-3">Message</dt>
                                <dd class="col-sm-9"><strong>{{ $errorLog->message }}</strong></dd>

                                <dt class="col-sm-3">Occurrences</dt>
                                <dd class="col-sm-9">
                                    <span class="badge bg-secondary">{{ $errorLog->occurrence_count }} time(s)</span>
                                </dd>

                                <dt class="col-sm-3">First Occurred</dt>
                                <dd class="col-sm-9">{{ $errorLog->created_at->format('Y-m-d H:i:s') }}</dd>

                                <dt class="col-sm-3">Last Occurred</dt>
                                <dd class="col-sm-9">{{ $errorLog->updated_at->format('Y-m-d H:i:s') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Location</h5>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                <dt class="col-sm-4">File</dt>
                                <dd class="col-sm-8">
                                    @if($errorLog->file)
                                        <code class="small">{{ $errorLog->file }}</code>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-4">Line</dt>
                                <dd class="col-sm-8">{{ $errorLog->line ?? '-' }}</dd>

                                <dt class="col-sm-4">Route</dt>
                                <dd class="col-sm-8">
                                    @if($errorLog->route)
                                        <code class="small">{{ $errorLog->route }}</code>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-4">Method</dt>
                                <dd class="col-sm-8">
                                    @if($errorLog->method)
                                        <span class="badge bg-primary">{{ $errorLog->method }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-4">URL</dt>
                                <dd class="col-sm-8">
                                    @if($errorLog->url)
                                        <small class="text-break">{{ $errorLog->url }}</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Request Information -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-person me-2"></i>Request Info</h5>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                <dt class="col-sm-4">User</dt>
                                <dd class="col-sm-8">
                                    @if($errorLog->user_id)
                                        @if($errorLog->user)
                                            {{ $errorLog->user->name }} ({{ $errorLog->user->email }})
                                        @else
                                            User ID: {{ $errorLog->user_id }}
                                        @endif
                                    @else
                                        <span class="text-muted">Guest</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-4">IP Address</dt>
                                <dd class="col-sm-8">
                                    @if($errorLog->ip_address)
                                        <code>{{ $errorLog->ip_address }}</code>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-4">Request Data</dt>
                                <dd class="col-sm-8">
                                    @if($errorLog->request_data && count($errorLog->request_data) > 0)
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="collapse" data-bs-target="#requestData">
                                            <i class="bi bi-eye me-1"></i>View Data
                                        </button>
                                    @else
                                        <span class="text-muted">No data</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Request Data (Collapsible) -->
                @if($errorLog->request_data && count($errorLog->request_data) > 0)
                    <div class="col-12 collapse" id="requestData">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-code-square me-2"></i>Request Data</h5>
                            </div>
                            <div class="card-body">
                                <div class="code-block">{{ json_encode($errorLog->request_data, JSON_PRETTY_PRINT) }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Stack Trace -->
                @if($errorLog->trace)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i>Stack Trace</h5>
                            </div>
                            <div class="card-body">
                                <div class="code-block">{{ $errorLog->trace }}</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex gap-2 justify-content-end">
                        @if(!$errorLog->is_resolved)
                            <form action="{{ route('admin.error-logs.resolve', $errorLog->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-action">
                                    <i class="bi bi-check-circle me-1"></i>Mark as Resolved
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.error-logs.destroy', $errorLog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this error log?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-action">
                                <i class="bi bi-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

