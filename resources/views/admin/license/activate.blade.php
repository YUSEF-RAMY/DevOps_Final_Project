@extends('admin.layouts.app')

@section('title', 'License Activation')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-key me-2"></i>License Activation
                    </h3>
                </div>
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="bi bi-info-circle text-primary me-2"></i>License Information
                                    </h5>
                                    
                                    <div class="mb-3">
                                        <strong>License Status:</strong>
                                        @if($licenseInfo['is_valid'])
                                            <span class="badge bg-success ms-2">
                                                <i class="bi bi-check-circle me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger ms-2">
                                                <i class="bi bi-x-circle me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </div>

                                    @if($licenseInfo['key'])
                                        <div class="mb-3">
                                            <strong>License Key:</strong>
                                            <code class="ms-2">{{ $licenseInfo['key'] }}</code>
                                        </div>
                                    @endif

                                    @if($licenseInfo['last_validation'])
                                        <div class="mb-3">
                                            <strong>Last Validated:</strong>
                                            <span class="ms-2">{{ $licenseInfo['last_validation']->format('d M Y, h:i A') }}</span>
                                        </div>
                                    @endif

                                    <div class="alert alert-info">
                                        <i class="bi bi-lightbulb me-2"></i>
                                        <strong>Note:</strong> Your license is validated every 24 hours. 
                                        An offline grace period of 7 days is available if the license server is unreachable.
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.license.activate.post') }}">
                                @csrf
                                
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h5 class="mb-3">
                                            <i class="bi bi-key-fill text-primary me-2"></i>Activate License
                                        </h5>

                                        <div class="mb-3">
                                            <label class="form-label">
                                                License Key <span class="text-danger">*</span>
                                            </label>
                                            <input 
                                                type="text" 
                                                name="license_key" 
                                                class="form-control form-control-lg @error('license_key') is-invalid @enderror" 
                                                placeholder="Enter your license key"
                                                value="{{ old('license_key') }}"
                                                required
                                                autofocus
                                            >
                                            @error('license_key')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">
                                                Enter the license key provided with your purchase.
                                            </small>
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="bi bi-check-circle me-2"></i>Activate License
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="mt-4 text-center">
                                <p class="text-muted mb-0">
                                    <i class="bi bi-question-circle me-1"></i>
                                    Need help? <a href="#" target="_blank">Contact Support</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

