@extends('frontend.installer.layout')

@section('title', 'Installation Complete')

@section('content')
<div class="text-center py-5">
    <div class="mb-4">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
    </div>
    
    <h2 class="mb-3">Installation Complete!</h2>
    <p class="text-muted mb-4">Your Laravel eCommerce store has been successfully installed and configured.</p>
    
    <div class="alert alert-info mb-4">
        <i class="bi bi-shield-check me-2"></i>
        <strong>Security Note:</strong> The installer has been disabled in the database for security purposes. 
        To re-enable it, update the <code>installer_enabled</code> setting in the <code>site_settings</code> table to <code>true</code>.
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
@endsection

