@extends('frontend.installer.layout')

@section('title', 'Installing')

@section('content')
<div class="step-indicator">
    <div class="step completed"><i class="bi bi-check"></i></div>
    <div class="step completed"><i class="bi bi-check"></i></div>
    <div class="step completed"><i class="bi bi-check"></i></div>
    <div class="step active">4</div>
</div>

<h2 class="mb-4"><i class="bi bi-gear-wide-connected me-2"></i>Installing Application</h2>
<p class="text-muted mb-4">Please wait while we set up your eCommerce store. This may take a few minutes.</p>

<div id="installationProgress">
    <div class="text-center py-5">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-3">Preparing installation...</p>
    </div>
</div>

<div id="installationComplete" class="d-none">
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
        </div>
        
        <h2 class="mb-3">Installation Complete!</h2>
        <p class="text-muted mb-4">Your Laravel eCommerce store has been successfully installed and configured.</p>
        
        <div class="alert alert-info mb-4">
            <i class="bi bi-shield-check me-2"></i>
            <strong>Security Note:</strong> The installer has been disabled in the database for security purposes. 
            Files remain intact but installer access is blocked.
        </div>
        
        <div class="card mb-4">
            <div class="card-body text-start">
                <h5 class="card-title"><i class="bi bi-info-circle me-2"></i>What's Next?</h5>
                <ul class="mb-0">
                    <li>Access your <strong>Admin Panel</strong> to manage your store</li>
                    <li>Configure <strong>Payment Gateways</strong> from Admin → Payment Gateways</li>
                    <li>Set up <strong>Shipping Settings</strong> from Admin → Shipping Settings</li>
                    <li>Customize your <strong>Site Settings</strong> from Admin → Site Settings</li>
                    <li>Add products and categories to start selling</li>
                </ul>
            </div>
        </div>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-install btn-lg me-md-2">
                <i class="bi bi-speedometer2 me-2"></i>Go to Admin Panel
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-house me-2"></i>Visit Storefront
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const progressDiv = document.getElementById('installationProgress');
    const completeDiv = document.getElementById('installationComplete');
    
    // Start installation
    fetch('{{ route("installer.process-install") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Display steps
            let html = '<div class="progress-steps">';
            data.steps.forEach((step, index) => {
                const statusClass = step.status === 'completed' ? 'completed' : 
                                   step.status === 'running' ? 'running' : '';
                html += `
                    <div class="progress-step ${statusClass}">
                        <div class="d-flex align-items-center">
                            ${step.status === 'completed' ? '<i class="bi bi-check-circle-fill text-success me-2"></i>' : 
                              step.status === 'running' ? '<span class="spinner-border spinner-border-sm text-primary me-2"></span>' : 
                              '<i class="bi bi-circle me-2"></i>'}
                            <span>${step.name}</span>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            progressDiv.innerHTML = html;
            
            // Show complete message
            setTimeout(() => {
                progressDiv.classList.add('d-none');
                completeDiv.classList.remove('d-none');
            }, 1000);
        } else {
            progressDiv.innerHTML = `
                <div class="alert alert-danger">
                    <h4><i class="bi bi-x-circle me-2"></i>Installation Failed</h4>
                    <p>${data.message}</p>
                    <div class="mt-3">
                        <a href="{{ route('installer.admin') }}" class="btn btn-outline-primary">Try Again</a>
                    </div>
                </div>
            `;
        }
    })
    .catch(error => {
        progressDiv.innerHTML = `
            <div class="alert alert-danger">
                <h4><i class="bi bi-x-circle me-2"></i>Installation Error</h4>
                <p>An error occurred during installation: ${error.message}</p>
                <div class="mt-3">
                    <a href="{{ route('installer.admin') }}" class="btn btn-outline-primary">Try Again</a>
                </div>
            </div>
        `;
    });
});
</script>
@endpush
@endsection

