@extends('admin.layouts.app')

@section('title', 'Configure Cash on Delivery')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="bi bi-truck me-2"></i>
                Configure Cash on Delivery
            </h1>
            <p class="text-muted">Manage Cash on Delivery payment method settings</p>
        </div>
        <div>
            <a href="{{ route('admin.payment-gateways.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Gateways
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Settings Form -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-cog me-2"></i>Cash on Delivery Settings
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payment-gateways.update', 'cod') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="enabled" value="1" 
                                           id="enabled" {{ ($settings->where('key', 'enabled')->first()->value ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="enabled">
                                        <strong>Enable Cash on Delivery</strong>
                                    </label>
                                </div>
                                <small class="text-muted">Enable or disable Cash on Delivery payment method. When enabled, customers can pay with cash when their order is delivered.</small>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Note:</strong> Cash on Delivery allows customers to pay for their orders when they receive them. This payment method doesn't require any API configuration.
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Gateway Info -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Payment Method Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <strong>Status:</strong><br>
                            <span class="badge {{ ($settings->where('key', 'enabled')->first()->value ?? true) ? 'bg-success' : 'bg-secondary' }}">
                                {{ ($settings->where('key', 'enabled')->first()->value ?? true) ? 'Enabled' : 'Disabled' }}
                            </span>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.payment-gateways.toggle-status', 'cod') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ ($settings->where('key', 'enabled')->first()->value ?? true) ? 'btn-warning' : 'btn-success' }} w-100">
                                <i class="fas fa-power-off me-1"></i>
                                {{ ($settings->where('key', 'enabled')->first()->value ?? true) ? 'Disable' : 'Enable' }} COD
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

