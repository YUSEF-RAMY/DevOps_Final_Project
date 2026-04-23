@extends('frontend.installer.layout')

@section('title', 'Admin Account Setup')

@section('content')
<div class="step-indicator">
    <div class="step completed"><i class="bi bi-check"></i></div>
    <div class="step completed"><i class="bi bi-check"></i></div>
    <div class="step active">3</div>
    <div class="step">4</div>
</div>

<h2 class="mb-4"><i class="bi bi-person-badge me-2"></i>Admin Account Setup</h2>
<p class="text-muted mb-4">Create your administrator account to manage your eCommerce store.</p>

<form id="adminForm">
    @csrf
    
    <div class="mb-3">
        <label for="name" class="form-label">Admin Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-lg" id="name" name="name" 
               value="{{ $adminData['name'] }}" required>
        <small class="text-muted">Your full name or display name</small>
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
        <input type="email" class="form-control form-control-lg" id="email" name="email" 
               value="{{ $adminData['email'] }}" required>
        <small class="text-muted">This will be used to log in to the admin panel</small>
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
        <input type="password" class="form-control form-control-lg" id="password" name="password" 
               required minlength="8">
        <small class="text-muted">Minimum 8 characters</small>
    </div>
    
    <div class="mb-4">
        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
        <input type="password" class="form-control form-control-lg" id="password_confirmation" 
               name="password_confirmation" required minlength="8">
    </div>
    
    <div class="alert alert-info">
        <i class="bi bi-info-circle me-2"></i>
        <strong>Note:</strong> Make sure to remember these credentials. You'll need them to access the admin panel.
    </div>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-between">
        <a href="{{ route('installer.database') }}" class="btn btn-outline-secondary btn-lg">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
        <button type="submit" class="btn btn-install btn-lg">
            <i class="bi bi-rocket-takeoff me-2"></i>Start Installation
        </button>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('adminForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
        
        fetch('{{ route("installer.install") }}', {
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
                window.location.href = '{{ route("installer.show-install") }}';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to save admin data',
                    confirmButtonColor: '#667eea'
                });
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-rocket-takeoff me-2"></i>Start Installation';
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
            submitBtn.innerHTML = '<i class="bi bi-rocket-takeoff me-2"></i>Start Installation';
        });
    });
});
</script>
@endpush
@endsection

