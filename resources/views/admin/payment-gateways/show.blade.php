@extends('admin.layouts.app')

@section('title', 'Configure ' . ucfirst($gateway) . ' Payment Gateway')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                @if($gateway === 'bkash')
                    <i class="bi bi-phone me-2"></i>
                @elseif($gateway === 'nagad')
                    <i class="bi bi-phone me-2"></i>
                @elseif($gateway === 'rocket')
                    <i class="bi bi-phone me-2"></i>
                @elseif($gateway === 'ssl_commerce')
                    <i class="bi bi-credit-card me-2"></i>
                @elseif($gateway === 'stripe')
                    <i class="fas fa-stripe me-2"></i>
                @elseif($gateway === 'paypal')
                    <i class="fas fa-paypal me-2"></i>
                @endif
                Configure {{ ucfirst(str_replace('_', ' ', $gateway)) }} Payment Gateway
            </h1>
            <p class="text-muted">Manage {{ ucfirst($gateway) }} payment gateway settings and configurations</p>
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
                        <i class="fas fa-cog me-2"></i>Gateway Settings
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payment-gateways.update', $gateway) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if($gateway === 'bkash')
                            <!-- bKash Settings -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="enabled" value="1" 
                                               id="enabled" {{ $gatewayInstance->isEnabled() ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enabled">
                                            <strong>Enable bKash Payment Gateway</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Enable or disable bKash payment processing</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="merchant_number" class="form-label">
                                        <i class="bi bi-phone me-1"></i>Merchant Number
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('merchant_number') is-invalid @enderror" 
                                           id="merchant_number" 
                                           name="merchant_number" 
                                           value="{{ old('merchant_number', $settings->where('key', 'merchant_number')->first()->value ?? '') }}"
                                           placeholder="017XXXXXXXX">
                                    @error('merchant_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your bKash merchant account number</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="api_key" class="form-label">
                                        <i class="fas fa-key me-1"></i>API Key
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('api_key') is-invalid @enderror" 
                                           id="api_key" 
                                           name="api_key" 
                                           value="{{ old('api_key', $settings->where('key', 'api_key')->first()->value ?? '') }}"
                                           placeholder="Your bKash API Key">
                                    @error('api_key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your bKash API key</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="api_secret" class="form-label">
                                        <i class="fas fa-lock me-1"></i>API Secret
                                    </label>
                                    <input type="password" 
                                           class="form-control @error('api_secret') is-invalid @enderror" 
                                           id="api_secret" 
                                           name="api_secret" 
                                           value="{{ old('api_secret', $settings->where('key', 'api_secret')->first()->value ?? '') }}"
                                           placeholder="Your bKash API Secret">
                                    @error('api_secret')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your bKash API secret - This will be encrypted</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="sandbox_mode" value="0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="sandbox_mode" value="1" 
                                               id="sandbox_mode" {{ ($settings->where('key', 'sandbox_mode')->first()->value ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sandbox_mode">
                                            <strong>Sandbox Mode</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Use bKash sandbox for testing (recommended for development)</small>
                                </div>
                            </div>

                        @elseif($gateway === 'nagad')
                            <!-- Nagad Settings -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="enabled" value="1" 
                                               id="enabled" {{ $gatewayInstance->isEnabled() ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enabled">
                                            <strong>Enable Nagad Payment Gateway</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Enable or disable Nagad payment processing</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="merchant_number" class="form-label">
                                        <i class="bi bi-phone me-1"></i>Merchant Number
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('merchant_number') is-invalid @enderror" 
                                           id="merchant_number" 
                                           name="merchant_number" 
                                           value="{{ old('merchant_number', $settings->where('key', 'merchant_number')->first()->value ?? '') }}"
                                           placeholder="017XXXXXXXX">
                                    @error('merchant_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your Nagad merchant account number</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="api_key" class="form-label">
                                        <i class="fas fa-key me-1"></i>API Key
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('api_key') is-invalid @enderror" 
                                           id="api_key" 
                                           name="api_key" 
                                           value="{{ old('api_key', $settings->where('key', 'api_key')->first()->value ?? '') }}"
                                           placeholder="Your Nagad API Key">
                                    @error('api_key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your Nagad API key</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="api_secret" class="form-label">
                                        <i class="fas fa-lock me-1"></i>API Secret
                                    </label>
                                    <input type="password" 
                                           class="form-control @error('api_secret') is-invalid @enderror" 
                                           id="api_secret" 
                                           name="api_secret" 
                                           value="{{ old('api_secret', $settings->where('key', 'api_secret')->first()->value ?? '') }}"
                                           placeholder="Your Nagad API Secret">
                                    @error('api_secret')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your Nagad API secret - This will be encrypted</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="sandbox_mode" value="0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="sandbox_mode" value="1" 
                                               id="sandbox_mode" {{ ($settings->where('key', 'sandbox_mode')->first()->value ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sandbox_mode">
                                            <strong>Sandbox Mode</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Use Nagad sandbox for testing (recommended for development)</small>
                                </div>
                            </div>

                        @elseif($gateway === 'rocket')
                            <!-- Rocket Settings -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="enabled" value="1" 
                                               id="enabled" {{ $gatewayInstance->isEnabled() ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enabled">
                                            <strong>Enable Rocket Payment Gateway</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Enable or disable Rocket payment processing</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="merchant_number" class="form-label">
                                        <i class="bi bi-phone me-1"></i>Merchant Number
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('merchant_number') is-invalid @enderror" 
                                           id="merchant_number" 
                                           name="merchant_number" 
                                           value="{{ old('merchant_number', $settings->where('key', 'merchant_number')->first()->value ?? '') }}"
                                           placeholder="017XXXXXXXX">
                                    @error('merchant_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your Rocket merchant account number</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="api_key" class="form-label">
                                        <i class="fas fa-key me-1"></i>API Key
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('api_key') is-invalid @enderror" 
                                           id="api_key" 
                                           name="api_key" 
                                           value="{{ old('api_key', $settings->where('key', 'api_key')->first()->value ?? '') }}"
                                           placeholder="Your Rocket API Key">
                                    @error('api_key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your Rocket API key</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="api_secret" class="form-label">
                                        <i class="fas fa-lock me-1"></i>API Secret
                                    </label>
                                    <input type="password" 
                                           class="form-control @error('api_secret') is-invalid @enderror" 
                                           id="api_secret" 
                                           name="api_secret" 
                                           value="{{ old('api_secret', $settings->where('key', 'api_secret')->first()->value ?? '') }}"
                                           placeholder="Your Rocket API Secret">
                                    @error('api_secret')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your Rocket API secret - This will be encrypted</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="sandbox_mode" value="0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="sandbox_mode" value="1" 
                                               id="sandbox_mode" {{ ($settings->where('key', 'sandbox_mode')->first()->value ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sandbox_mode">
                                            <strong>Sandbox Mode</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Use Rocket sandbox for testing (recommended for development)</small>
                                </div>
                            </div>

                        @elseif($gateway === 'ssl_commerce')
                            <!-- SSL Commerce Settings -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="enabled" value="1" 
                                               id="enabled" {{ $gatewayInstance->isEnabled() ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enabled">
                                            <strong>Enable SSL Commerce Payment Gateway</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Enable or disable SSL Commerce payment processing</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="store_id" class="form-label">
                                        <i class="fas fa-store me-1"></i>Store ID *
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('store_id') is-invalid @enderror" 
                                           id="store_id" 
                                           name="store_id" 
                                           value="{{ old('store_id', $settings->where('key', 'store_id')->first()->value ?? '') }}"
                                           placeholder="Your SSL Commerce Store ID">
                                    @error('store_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your SSL Commerce store ID</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="store_password" class="form-label">
                                        <i class="fas fa-lock me-1"></i>Store Password *
                                    </label>
                                    <input type="password" 
                                           class="form-control @error('store_password') is-invalid @enderror" 
                                           id="store_password" 
                                           name="store_password" 
                                           value="{{ old('store_password', $settings->where('key', 'store_password')->first()->value ?? '') }}"
                                           placeholder="Your SSL Commerce Store Password">
                                    @error('store_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your SSL Commerce store password - This will be encrypted</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="api_url" class="form-label">
                                        <i class="fas fa-link me-1"></i>API URL
                                    </label>
                                    <input type="url" 
                                           class="form-control @error('api_url') is-invalid @enderror" 
                                           id="api_url" 
                                           name="api_url" 
                                           value="{{ old('api_url', $settings->where('key', 'api_url')->first()->value ?? 'https://sandbox.sslcommerz.com') }}"
                                           placeholder="https://sandbox.sslcommerz.com">
                                    @error('api_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">SSL Commerce API URL (default: sandbox.sslcommerz.com for testing)</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="sandbox_mode" value="0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="sandbox_mode" value="1" 
                                               id="sandbox_mode" {{ ($settings->where('key', 'sandbox_mode')->first()->value ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sandbox_mode">
                                            <strong>Sandbox Mode</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Use SSL Commerce sandbox for testing (recommended for development)</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="success_url" class="form-label">
                                        <i class="fas fa-check-circle me-1"></i>Success URL
                                    </label>
                                    <input type="url" 
                                           class="form-control @error('success_url') is-invalid @enderror" 
                                           id="success_url" 
                                           name="success_url" 
                                           value="{{ old('success_url', $settings->where('key', 'success_url')->first()->value ?? '') }}"
                                           placeholder="https://yoursite.com/payment/success">
                                    @error('success_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">URL to redirect after successful payment</small>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="fail_url" class="form-label">
                                        <i class="fas fa-times-circle me-1"></i>Fail URL
                                    </label>
                                    <input type="url" 
                                           class="form-control @error('fail_url') is-invalid @enderror" 
                                           id="fail_url" 
                                           name="fail_url" 
                                           value="{{ old('fail_url', $settings->where('key', 'fail_url')->first()->value ?? '') }}"
                                           placeholder="https://yoursite.com/payment/fail">
                                    @error('fail_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">URL to redirect after failed payment</small>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="cancel_url" class="form-label">
                                        <i class="fas fa-ban me-1"></i>Cancel URL
                                    </label>
                                    <input type="url" 
                                           class="form-control @error('cancel_url') is-invalid @enderror" 
                                           id="cancel_url" 
                                           name="cancel_url" 
                                           value="{{ old('cancel_url', $settings->where('key', 'cancel_url')->first()->value ?? '') }}"
                                           placeholder="https://yoursite.com/payment/cancel">
                                    @error('cancel_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">URL to redirect after cancelled payment</small>
                                </div>
                            </div>

                        @elseif($gateway === 'stripe')
                            <!-- Stripe Settings -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="enabled" value="1" 
                                               id="enabled" {{ $gatewayInstance->isEnabled() ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enabled">
                                            <strong>Enable Stripe Payment Gateway</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Enable or disable Stripe payment processing</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="publishable_key" class="form-label">
                                        <i class="fas fa-key me-1"></i>Publishable Key *
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('publishable_key') is-invalid @enderror" 
                                           id="publishable_key" 
                                           name="publishable_key" 
                                           value="{{ old('publishable_key', $settings->where('key', 'publishable_key')->first()->value ?? '') }}"
                                           placeholder="pk_test_...">
                                    @error('publishable_key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your Stripe publishable key (starts with pk_)</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="secret_key" class="form-label">
                                        <i class="fas fa-lock me-1"></i>Secret Key *
                                    </label>
                                    <input type="password" 
                                           class="form-control @error('secret_key') is-invalid @enderror" 
                                           id="secret_key" 
                                           name="secret_key" 
                                           value="{{ old('secret_key', $settings->where('key', 'secret_key')->first()->value ?? '') }}"
                                           placeholder="sk_test_...">
                                    @error('secret_key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your Stripe secret key (starts with sk_) - This will be encrypted</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="webhook_secret" class="form-label">
                                        <i class="fas fa-webhook me-1"></i>Webhook Secret
                                    </label>
                                    <input type="password" 
                                           class="form-control @error('webhook_secret') is-invalid @enderror" 
                                           id="webhook_secret" 
                                           name="webhook_secret" 
                                           value="{{ old('webhook_secret', $settings->where('key', 'webhook_secret')->first()->value ?? '') }}"
                                           placeholder="whsec_...">
                                    @error('webhook_secret')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Stripe webhook endpoint secret for secure webhook verification</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="sandbox_mode" value="0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="sandbox_mode" value="1" 
                                               id="sandbox_mode" {{ ($settings->where('key', 'sandbox_mode')->first()->value ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sandbox_mode">
                                            <strong>Test Mode</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Use Stripe test mode for testing (recommended for development)</small>
                                </div>
                            </div>

                        @elseif($gateway === 'paypal')
                            <!-- PayPal Settings -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="enabled" value="1" 
                                               id="enabled" {{ $gatewayInstance->isEnabled() ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enabled">
                                            <strong>Enable PayPal Payment Gateway</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Enable or disable PayPal payment processing</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="client_id" class="form-label">
                                        <i class="fas fa-id-card me-1"></i>Client ID *
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('client_id') is-invalid @enderror" 
                                           id="client_id" 
                                           name="client_id" 
                                           value="{{ old('client_id', $settings->where('key', 'client_id')->first()->value ?? '') }}"
                                           placeholder="Your PayPal Client ID">
                                    @error('client_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your PayPal application client ID</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="client_secret" class="form-label">
                                        <i class="fas fa-lock me-1"></i>Client Secret *
                                    </label>
                                    <input type="password" 
                                           class="form-control @error('client_secret') is-invalid @enderror" 
                                           id="client_secret" 
                                           name="client_secret" 
                                           value="{{ old('client_secret', $settings->where('key', 'client_secret')->first()->value ?? '') }}"
                                           placeholder="Your PayPal Client Secret">
                                    @error('client_secret')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Your PayPal application client secret - This will be encrypted</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="sandbox_mode" value="0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="sandbox_mode" value="1" 
                                               id="sandbox_mode" {{ $settings->where('key', 'sandbox_mode')->first()->value ?? true ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sandbox_mode">
                                            <strong>Sandbox Mode</strong>
                                        </label>
                                    </div>
                                    <small class="text-muted">Use PayPal sandbox for testing (recommended for development)</small>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Save Settings
                            </button>
                            
                            <button type="button" class="btn btn-info test-connection" data-gateway="{{ $gateway }}">
                                <i class="fas fa-plug me-1"></i>Test Connection
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Gateway Info & Logs -->
        <div class="col-lg-4">
            <!-- Gateway Status -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Gateway Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <strong>Status:</strong><br>
                            <span class="badge {{ $gatewayInstance->isEnabled() ? 'bg-success' : 'bg-secondary' }}">
                                {{ $gatewayInstance->isEnabled() ? 'Enabled' : 'Disabled' }}
                            </span>
                        </div>
                        <div class="col-6">
                            <strong>Mode:</strong><br>
                            @php
                                $sandboxMode = $settings->where('key', 'sandbox_mode')->first()->value ?? true;
                            @endphp
                            <span class="badge {{ $sandboxMode ? 'bg-warning text-dark' : 'bg-primary' }}">
                                {{ $sandboxMode ? 'Sandbox/Test' : 'Live' }}
                            </span>
                        </div>
                    </div>
                    
                    @if($sandboxMode)
                        <div class="alert alert-info mt-3 mb-0 py-2">
                            <small>
                                <i class="bi bi-info-circle me-1"></i>
                                <strong>Sandbox Mode Active:</strong> Using test credentials. All transactions are for testing only.
                            </small>
                        </div>
                    @endif
                    
                    <hr>
                    
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.payment-gateways.toggle-status', $gateway) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $gatewayInstance->isEnabled() ? 'btn-warning' : 'btn-success' }} w-100">
                                <i class="fas fa-power-off me-1"></i>
                                {{ $gatewayInstance->isEnabled() ? 'Disable' : 'Enable' }} Gateway
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Recent Logs -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-history me-2"></i>Recent Activity
                    </h6>
                </div>
                <div class="card-body">
                    @if($logs->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($logs->take(10) as $log)
                                <div class="list-group-item px-0 py-2">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <code class="text-primary">{{ $log->action }}</code>
                                            <br>
                                            <small class="text-muted">@formatDate($log->created_at)</small>
                                        </div>
                                        @if($log->data)
                                            <button type="button" class="btn btn-sm btn-outline-info" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#logModal{{ $log->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Log Data Modal -->
                                @if($log->data)
                                    <div class="modal fade" id="logModal{{ $log->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Log Data - {{ $log->action }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <pre class="bg-light p-3 rounded"><code>{{ json_encode($log->data, JSON_PRETTY_PRINT) }}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-history fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No activity logs found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Test Connection Modal -->
<div class="modal fade" id="testConnectionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Test {{ ucfirst($gateway) }} Connection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="testResult"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Test connection functionality
    document.querySelectorAll('.test-connection').forEach(button => {
        button.addEventListener('click', function() {
            const gateway = this.dataset.gateway;
            const modal = new bootstrap.Modal(document.getElementById('testConnectionModal'));
            const resultDiv = document.getElementById('testResult');
            
            resultDiv.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><br>Testing connection...</div>';
            modal.show();
            
            fetch(`{{ route('admin.payment-gateways.index') }}/${gateway}/test`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resultDiv.innerHTML = `
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Success!</strong> ${data.message}
                        </div>
                        <pre class="bg-light p-2 rounded"><code>${JSON.stringify(data.details, null, 2)}</code></pre>
                    `;
                } else {
                    resultDiv.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Failed!</strong> ${data.message}
                        </div>
                    `;
                }
            })
            .catch(error => {
                resultDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Error!</strong> ${error.message}
                    </div>
                `;
            });
        });
    });
});
</script>
@endsection

