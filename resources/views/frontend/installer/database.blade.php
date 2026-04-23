@extends('frontend.installer.layout')

@section('title', 'Database Configuration')

@section('content')
<div class="step-indicator">
    <div class="step completed"><i class="bi bi-check"></i></div>
    <div class="step active">2</div>
    <div class="step">3</div>
    <div class="step">4</div>
</div>

<h2 class="mb-4"><i class="bi bi-database me-2"></i>Database Configuration</h2>
<p class="text-muted mb-4">Please provide your database connection details.</p>

<form id="databaseForm">
    @csrf
    
    <div class="mb-3">
        <label for="host" class="form-label">Database Host <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-lg" id="host" name="host" 
               value="{{ $dbConfig['host'] }}" required>
        <small class="text-muted">Usually '127.0.0.1' or 'localhost'</small>
    </div>
    
    <div class="mb-3">
        <label for="port" class="form-label">Database Port <span class="text-danger">*</span></label>
        <input type="number" class="form-control form-control-lg" id="port" name="port" 
               value="{{ $dbConfig['port'] }}" required min="1" max="65535">
        <small class="text-muted">Default MySQL port is 3306</small>
    </div>
    
    <div class="mb-3">
        <label for="database" class="form-label">Database Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-lg" id="database" name="database" 
               value="{{ $dbConfig['database'] }}" required>
        <small class="text-muted">Database will be created if it doesn't exist</small>
    </div>
    
    <div class="mb-3">
        <label for="username" class="form-label">Database Username <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-lg" id="username" name="username" 
               value="{{ $dbConfig['username'] }}" required>
    </div>
    
    <div class="mb-4">
        <label for="password" class="form-label">Database Password</label>
        <input type="password" class="form-control form-control-lg" id="password" name="password" 
               value="{{ $dbConfig['password'] }}">
        <small class="text-muted">Leave empty if no password is set</small>
    </div>
    
    <div id="testResult" class="mb-3"></div>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-between">
        <a href="{{ route('installer.index') }}" class="btn btn-outline-secondary btn-lg">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
        <div>
            <button type="button" id="testBtn" class="btn btn-outline-primary btn-lg me-2">
                <i class="bi bi-plug me-2"></i>Test Connection
            </button>
            <button type="submit" class="btn btn-install btn-lg">
                <i class="bi bi-arrow-right me-2"></i>Continue
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('databaseForm');
    const testBtn = document.getElementById('testBtn');
    const testResult = document.getElementById('testResult');
    
    testBtn.addEventListener('click', function() {
        const formData = new FormData(form);
        testBtn.disabled = true;
        testBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Testing...';
        testResult.innerHTML = '';
        
        fetch('{{ route("installer.test-database") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            testBtn.disabled = false;
            testBtn.innerHTML = '<i class="bi bi-plug me-2"></i>Test Connection';
            
            if (data.satisfied) {
                testResult.innerHTML = `
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>
                        <strong>Success!</strong> ${data.message}
                    </div>
                `;
            } else {
                testResult.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="bi bi-x-circle me-2"></i>
                        <strong>Failed!</strong> ${data.message}
                    </div>
                `;
            }
        })
        .catch(error => {
            testBtn.disabled = false;
            testBtn.innerHTML = '<i class="bi bi-plug me-2"></i>Test Connection';
            testResult.innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-x-circle me-2"></i>
                    <strong>Error!</strong> ${error.message}
                </div>
            `;
        });
    });
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
        
        fetch('{{ route("installer.save-database") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("installer.admin") }}';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to save database configuration',
                    confirmButtonColor: '#667eea'
                });
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-arrow-right me-2"></i>Continue';
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'An error occurred',
                confirmButtonColor: '#667eea'
            });
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-arrow-right me-2"></i>Continue';
        });
    });
});
</script>
@endpush
@endsection

