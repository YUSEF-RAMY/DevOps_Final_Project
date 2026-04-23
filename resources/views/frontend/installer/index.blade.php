@extends('frontend.installer.layout')

@section('title', 'System Requirements')

@section('content')
@if(isset($isInstalled) && $isInstalled)
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <strong>Warning:</strong> The application appears to be already installed. 
        Running the installer again will reset your database and configuration.
    </div>
@endif

<h2 class="mb-4"><i class="bi bi-list-check me-2"></i>System Requirements</h2>
<p class="text-muted mb-4">Please ensure all requirements are met before proceeding with the installation.</p>

<div class="mb-4">
    <h5 class="mb-3">PHP Version</h5>
    <div class="requirement-item {{ $requirements['php_version']['satisfied'] ? 'satisfied' : 'not-satisfied' }}">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>PHP {{ $requirements['php_version']['required'] }}</strong>
                <p class="mb-0 text-muted small">{{ $requirements['php_version']['message'] }}</p>
            </div>
            <div>
                @if($requirements['php_version']['satisfied'])
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                @else
                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 1.5rem;"></i>
                @endif
            </div>
        </div>
        <small class="text-muted">Current: {{ $requirements['php_version']['current'] }}</small>
    </div>
</div>

<div class="mb-4">
    <h5 class="mb-3">PHP Extensions</h5>
    @foreach($requirements['php_extensions']['extensions'] as $extension)
        <div class="requirement-item {{ $extension['satisfied'] ? 'satisfied' : 'not-satisfied' }}">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $extension['name'] }}</strong>
                    <p class="mb-0 text-muted small">{{ $extension['message'] }}</p>
                </div>
                <div>
                    @if($extension['satisfied'])
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                    @else
                        <i class="bi bi-x-circle-fill text-danger" style="font-size: 1.5rem;"></i>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mb-4">
    <h5 class="mb-3">Folder Permissions</h5>
    @foreach($requirements['folder_permissions']['folders'] as $folder)
        <div class="requirement-item {{ $folder['satisfied'] ? 'satisfied' : 'not-satisfied' }}">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $folder['name'] }}</strong>
                    <p class="mb-0 text-muted small">{{ $folder['message'] }}</p>
                    <small class="text-muted">{{ $folder['path'] }}</small>
                </div>
                <div>
                    @if($folder['satisfied'])
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                    @else
                        <i class="bi bi-x-circle-fill text-danger" style="font-size: 1.5rem;"></i>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mb-4">
    <h5 class="mb-3">Environment File</h5>
    <div class="requirement-item {{ $requirements['env_file']['satisfied'] ? 'satisfied' : 'not-satisfied' }}">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>.env File</strong>
                <p class="mb-0 text-muted small">{{ $requirements['env_file']['message'] }}</p>
            </div>
            <div>
                @if($requirements['env_file']['satisfied'])
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                @else
                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 1.5rem;"></i>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    @if($allSatisfied)
        <a href="{{ route('installer.database') }}" class="btn btn-install btn-lg">
            <i class="bi bi-arrow-right me-2"></i>Continue to Database Setup
        </a>
    @else
        <button class="btn btn-secondary btn-lg" disabled>
            <i class="bi bi-x-circle me-2"></i>Please Fix Requirements First
        </button>
    @endif
</div>
@endsection

