@extends('themes.theme1.layouts.app')

@section('title', 'Checkout')

@push('styles')
<style>
    /* Fix z-index for Order Summary on checkout page */
    @media (min-width: 992px) {
        .checkout-order-summary {
            position: sticky;
            top: 80px;
            z-index: 100;
            max-height: calc(100vh - 100px);
            overflow-y: auto;
        }
    }
    
    /* Ensure navbar stays above Order Summary */
    .navbar.sticky-top {
        z-index: 1020;
    }
    
    /* Mobile: Don't use sticky on small screens */
    @media (max-width: 991.98px) {
        .checkout-order-summary {
            position: relative;
            top: auto;
            z-index: auto;
            max-height: none;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-5 fw-bold mb-0">
                    <i class="bi bi-credit-card me-2"></i>Checkout
                </h1>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-primary btn-custom">
                    <i class="bi bi-arrow-left me-2"></i>Back to Cart
                </a>
            </div>
        </div>
    </div>

    @if($cart->items->count() === 0)
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body py-5">
                        <i class="bi bi-cart-x display-1 text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">Your cart is empty</h3>
                        <p class="text-muted mb-4">
                            You need to add items to your cart before proceeding to checkout.
                        </p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg btn-custom">
                            <i class="bi bi-grid me-2"></i>Start Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <form action="{{ route('checkout.place') }}" method="post">
            @csrf
            <div class="row">
                <!-- Billing Information -->
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-person me-2"></i>Billing Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="billing_name" class="form-label fw-semibold">
                                        <i class="bi bi-person me-1"></i>Full Name *
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('billing_name') is-invalid @enderror" 
                                           id="billing_name" 
                                           name="billing_name" 
                                           value="{{ old('billing_name') ?: ($defaultBillingAddress ? trim($defaultBillingAddress->first_name . ' ' . $defaultBillingAddress->last_name) : (auth()->user()->name ?? '')) }}" 
                                           placeholder="Enter your full name" 
                                           required>
                                    @error('billing_name')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="billing_email" class="form-label fw-semibold">
                                        <i class="bi bi-envelope me-1"></i>Email Address *
                                    </label>
                                    <input type="email" 
                                           class="form-control @error('billing_email') is-invalid @enderror" 
                                           id="billing_email" 
                                           name="billing_email" 
                                           value="{{ old('billing_email', auth()->user()->email ?? '') }}" 
                                           placeholder="Enter your email" 
                                           required>
                                    @error('billing_email')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="billing_phone" class="form-label fw-semibold">
                                        <i class="bi bi-telephone me-1"></i>Phone Number *
                                    </label>
                                    <input type="tel" 
                                           class="form-control @error('billing_phone') is-invalid @enderror" 
                                           id="billing_phone" 
                                           name="billing_phone" 
                                           value="{{ old('billing_phone') ?: ($defaultBillingAddress ? $defaultBillingAddress->phone : (auth()->user()->phone ?? '')) }}" 
                                           placeholder="01XXXXXXXXX"
                                           required>
                                    @error('billing_phone')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="billing_country" class="form-label fw-semibold">
                                        <i class="bi bi-globe me-1"></i>Country
                                    </label>
                                    <select class="form-select @error('billing_country') is-invalid @enderror" 
                                            id="billing_country" 
                                            name="billing_country">
                                        @php
                                            $billingCountry = old('billing_country') ?: ($defaultBillingAddress ? $defaultBillingAddress->country : 'Bangladesh');
                                        @endphp
                                        <option value="Bangladesh" {{ $billingCountry == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                    </select>
                                    @error('billing_country')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="billing_address" class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt me-1"></i>Address
                                </label>
                                <input type="text" 
                                       class="form-control @error('billing_address') is-invalid @enderror" 
                                       id="billing_address" 
                                       name="billing_address" 
                                       value="{{ old('billing_address') ?: ($defaultBillingAddress ? trim($defaultBillingAddress->address_line_1 . ($defaultBillingAddress->address_line_2 ? ', ' . $defaultBillingAddress->address_line_2 : '')) : '') }}" 
                                       placeholder="Enter your address">
                                @error('billing_address')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="billing_division" class="form-label fw-semibold">
                                        <i class="bi bi-geo me-1"></i>Division
                                    </label>
                                    <select class="form-select @error('billing_division') is-invalid @enderror" 
                                            id="billing_division" 
                                            name="billing_division">
                                        <option value="">Select Division</option>
                                        @php
                                            $selectedDivision = old('billing_division') ?: ($defaultBillingAddress && $defaultBillingAddress->division ? $defaultBillingAddress->division : '');
                                        @endphp
                                        <option value="Dhaka" {{ $selectedDivision == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                                        <option value="Chittagong" {{ $selectedDivision == 'Chittagong' ? 'selected' : '' }}>Chittagong</option>
                                        <option value="Rajshahi" {{ $selectedDivision == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                                        <option value="Khulna" {{ $selectedDivision == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                                        <option value="Barisal" {{ $selectedDivision == 'Barisal' ? 'selected' : '' }}>Barisal</option>
                                        <option value="Sylhet" {{ $selectedDivision == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                                        <option value="Rangpur" {{ $selectedDivision == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                                        <option value="Mymensingh" {{ $selectedDivision == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                                    </select>
                                    @error('billing_division')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="billing_district" class="form-label fw-semibold">
                                        <i class="bi bi-geo me-1"></i>District
                                    </label>
                                    <select class="form-select @error('billing_district') is-invalid @enderror" 
                                            id="billing_district" 
                                            name="billing_district">
                                        <option value="">Select District</option>
                                        @php
                                            $selectedDivision = old('billing_division') ?: ($defaultBillingAddress && $defaultBillingAddress->division ? $defaultBillingAddress->division : '');
                                            $selectedDistrict = old('billing_district') ?: ($defaultBillingAddress && $defaultBillingAddress->district ? $defaultBillingAddress->district : '');
                                        @endphp
                                        @if($selectedDivision)
                                            @foreach($districts->where('division', $selectedDivision) as $district)
                                                <option value="{{ $district->name }}" 
                                                    data-district-id="{{ $district->id }}"
                                                    data-division="{{ $district->division }}"
                                                    {{ $selectedDistrict == $district->name ? 'selected' : '' }}>
                                                    {{ $district->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('billing_district')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="billing_upazila" class="form-label fw-semibold">
                                        <i class="bi bi-geo me-1"></i>Upazila/Thana
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('billing_upazila') is-invalid @enderror" 
                                           id="billing_upazila" 
                                           name="billing_upazila" 
                                           value="{{ old('billing_upazila') ?: ($defaultBillingAddress && $defaultBillingAddress->upazila ? $defaultBillingAddress->upazila : '') }}" 
                                           placeholder="Upazila/Thana">
                                    @error('billing_upazila')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="billing_postcode" class="form-label fw-semibold">
                                        <i class="bi bi-mailbox me-1"></i>Postal Code
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('billing_postcode') is-invalid @enderror" 
                                           id="billing_postcode" 
                                           name="billing_postcode" 
                                           value="{{ old('billing_postcode') ?: ($defaultBillingAddress ? $defaultBillingAddress->postal_code : '') }}" 
                                           placeholder="Postal Code">
                                    @error('billing_postcode')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-credit-card me-2"></i>Payment Method
                            </h5>
                        </div>
                        <div class="card-body">
                            @php
                                $hasBkash = isset($gateways['bkash']);
                                $hasNagad = isset($gateways['nagad']);
                                $hasRocket = isset($gateways['rocket']);
                                $hasSslCommerce = isset($gateways['ssl_commerce']);
                                $hasStripe = isset($gateways['stripe']);
                                $hasPaypal = isset($gateways['paypal']);
                                $hasCod = isset($gateways['cod']);
                            @endphp

                            @if(!$hasBkash && !$hasNagad && !$hasRocket && !$hasSslCommerce && !$hasStripe && !$hasPaypal && !$hasCod)
                                <div class="alert alert-warning">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    No payment gateways are enabled. Please contact support.
                                </div>
                            @endif
                            
                            <div class="row g-3">
                                @if($hasBkash)
                                    <div class="col-md-6">
                                        <div class="form-check border rounded p-3 h-100">
                                            <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_bkash" value="bkash" {{ old('gateway') === 'bkash' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gateway_bkash">
                                                <i class="bi bi-phone me-2"></i>bKash
                                            </label>
                                            <div class="text-muted small mt-2">You will be redirected to bKash payment page to complete the transaction.</div>
                                            @if(($gatewaySandboxModes['bkash'] ?? true))
                                                <div class="badge bg-info mt-1">Sandbox Mode</div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if($hasNagad)
                                    <div class="col-md-6">
                                        <div class="form-check border rounded p-3 h-100">
                                            <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_nagad" value="nagad" {{ old('gateway') === 'nagad' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gateway_nagad">
                                                <i class="bi bi-phone me-2"></i>Nagad
                                            </label>
                                            <div class="text-muted small mt-2">You will be redirected to Nagad payment page to complete the transaction.</div>
                                            @if(($gatewaySandboxModes['nagad'] ?? true))
                                                <div class="badge bg-info mt-1">Sandbox Mode</div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if($hasRocket)
                                    <div class="col-md-6">
                                        <div class="form-check border rounded p-3 h-100">
                                            <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_rocket" value="rocket" {{ old('gateway') === 'rocket' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gateway_rocket">
                                                <i class="bi bi-phone me-2"></i>Rocket
                                            </label>
                                            <div class="text-muted small mt-2">You will be redirected to Rocket payment page to complete the transaction.</div>
                                            @if(($gatewaySandboxModes['rocket'] ?? true))
                                                <div class="badge bg-info mt-1">Sandbox Mode</div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if($hasSslCommerce)
                                    <div class="col-md-6">
                                        <div class="form-check border rounded p-3 h-100">
                                            <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_ssl_commerce" value="ssl_commerce" {{ old('gateway') === 'ssl_commerce' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gateway_ssl_commerce">
                                                <i class="bi bi-credit-card me-2"></i>SSL Commerce
                                            </label>
                                            <div class="text-muted small mt-2">Pay securely with card, mobile banking, or bank transfer.</div>
                                            @if(($gatewaySandboxModes['ssl_commerce'] ?? true))
                                                <div class="badge bg-info mt-1">Sandbox Mode</div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if($hasCod)
                                    <div class="col-md-6">
                                        <div class="form-check border rounded p-3 h-100">
                                            <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_cod" value="cod" {{ old('gateway', (!$hasBkash && !$hasNagad && !$hasRocket && !$hasSslCommerce) ? 'cod' : '') === 'cod' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gateway_cod">
                                                <i class="bi bi-truck me-2"></i>Cash on Delivery
                                            </label>
                                            <div class="text-muted small mt-2">Pay with cash upon delivery.</div>
                                        </div>
                                    </div>
                                @endif

                                @if($hasStripe)
                                    <div class="col-md-6">
                                        <div class="form-check border rounded p-3 h-100">
                                            <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_stripe" value="stripe" {{ old('gateway') === 'stripe' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gateway_stripe">
                                                <i class="bi bi-credit-card me-2"></i>Stripe
                                            </label>
                                            <div class="text-muted small mt-2">Pay securely with your card via Stripe.</div>
                                            @if(($gatewaySandboxModes['stripe'] ?? true))
                                                <div class="badge bg-info mt-1">Test Mode</div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if($hasPaypal)
                                    <div class="col-md-6">
                                        <div class="form-check border rounded p-3 h-100">
                                            <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_paypal" value="paypal" {{ old('gateway') === 'paypal' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gateway_paypal">
                                                <i class="bi bi-paypal me-2"></i>PayPal
                                            </label>
                                            <div class="text-muted small mt-2">Checkout quickly with your PayPal account.</div>
                                            @if(($gatewaySandboxModes['paypal'] ?? true))
                                                <div class="badge bg-info mt-1">Sandbox Mode</div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            @error('gateway')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // District dynamic loading - DO THIS FIRST
                                    const divisionSelect = document.getElementById('billing_division');
                                    const districtSelect = document.getElementById('billing_district');
                                    
                                    // Districts data from server
                                    const districtsData = @json($districts->map(function($d) {
                                        return ['id' => $d->id, 'name' => $d->name, 'division' => $d->division];
                                    }));
                                    
                                    // Debug: Log districts data
                                    console.log('Districts Data Loaded:', districtsData.length, 'districts');
                                    if (districtsData.length > 0) {
                                        console.log('Sample district:', districtsData[0]);
                                        console.log('Unique divisions:', [...new Set(districtsData.map(d => d.division))]);
                                    }
                                    
                                    // Currency formatting (simplified for BDT)
                                    const CURRENCY = {
                                        symbol: '৳',
                                        symbol_first: true,
                                        precision: 2,
                                        decimal: '.',
                                        thousand: ',',
                                    };
                                    
                                    function formatCurrency(value) {
                                        const n = Number(value || 0);
                                        const sign = n < 0 ? '-' : '';
                                        const abs = Math.abs(n);
                                        const fixed = abs.toFixed(CURRENCY.precision);
                                        const parts = fixed.split('.');
                                        let intPart = parts[0];
                                        const re = /(\d+)(\d{3})/;
                                        while(re.test(intPart)) { 
                                            intPart = intPart.replace(re, `$1${CURRENCY.thousand}$2`); 
                                        }
                                        const frac = parts.length > 1 ? CURRENCY.decimal + parts[1] : '';
                                        const num = sign + intPart + frac;
                                        return CURRENCY.symbol_first 
                                            ? (sign + CURRENCY.symbol + intPart + frac).replace('--','-') 
                                            : (num + ' ' + CURRENCY.symbol).trim();
                                    }
                                    
                                    // Function to calculate and update shipping/tax
                                    function updateShippingAndTax() {
                                        let division = divisionSelect.value;
                                        let district = districtSelect.value;
                                        
                                        // If district is selected but division is not, try to get division from district data
                                        if (!division && district) {
                                            const selectedOption = districtSelect.options[districtSelect.selectedIndex];
                                            const districtDivision = selectedOption?.getAttribute('data-division');
                                            if (districtDivision) {
                                                division = districtDivision;
                                            }
                                        }
                                        
                                        // Get elements
                                        const taxElement = document.getElementById('order-tax');
                                        const shippingElement = document.getElementById('order-shipping');
                                        const totalElement = document.getElementById('order-total');
                                        
                                        if (!taxElement || !shippingElement || !totalElement) {
                                            console.error('Order summary elements not found');
                                            return;
                                        }
                                        
                                        if (!division && !district) {
                                            // Reset to default if nothing selected
                                            const originalTax = taxElement.getAttribute('data-original');
                                            const originalShipping = shippingElement.getAttribute('data-original');
                                            const originalTotal = totalElement.getAttribute('data-original');
                                            
                                            if (originalTax) taxElement.textContent = originalTax;
                                            if (originalShipping) shippingElement.textContent = originalShipping;
                                            if (originalTotal) totalElement.textContent = originalTotal;
                                            return;
                                        }
                                        
                                        // Store original values if not already stored
                                        if (!taxElement.getAttribute('data-original')) {
                                            taxElement.setAttribute('data-original', taxElement.textContent);
                                        }
                                        if (!shippingElement.getAttribute('data-original')) {
                                            shippingElement.setAttribute('data-original', shippingElement.textContent);
                                        }
                                        if (!totalElement.getAttribute('data-original')) {
                                            totalElement.setAttribute('data-original', totalElement.textContent);
                                        }
                                        
                                        // Show loading state
                                        taxElement.textContent = '...';
                                        shippingElement.textContent = '...';
                                        totalElement.textContent = '...';
                                        
                                        // Make API call to calculate shipping and tax
                                        fetch('{{ route("checkout.calculate-shipping-tax") }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Accept': 'application/json'
                                            },
                                            body: JSON.stringify({
                                                division: division,
                                                district: district
                                            })
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            console.log('Shipping/Tax calculation response:', data);
                                            if (data.success) {
                                                taxElement.textContent = formatCurrency(data.tax);
                                                shippingElement.textContent = formatCurrency(data.shipping);
                                                totalElement.textContent = formatCurrency(data.total);
                                            } else {
                                                console.error('API returned error:', data.message);
                                                // Restore original values on error
                                                taxElement.textContent = taxElement.getAttribute('data-original') || formatCurrency(0);
                                                shippingElement.textContent = shippingElement.getAttribute('data-original') || formatCurrency(0);
                                                totalElement.textContent = totalElement.getAttribute('data-original') || formatCurrency(0);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error calculating shipping/tax:', error);
                                            // Restore original values on error
                                            taxElement.textContent = taxElement.getAttribute('data-original') || formatCurrency(0);
                                            shippingElement.textContent = shippingElement.getAttribute('data-original') || formatCurrency(0);
                                            totalElement.textContent = totalElement.getAttribute('data-original') || formatCurrency(0);
                                        });
                                    }
                                    
                                    // Load districts when division changes
                                    if (divisionSelect && districtSelect) {
                                        console.log('Division and District selects found, attaching event listeners');
                                        
                                        divisionSelect.addEventListener('change', function() {
                                            const selectedDivision = this.value.trim();
                                            console.log('Division changed to:', selectedDivision);
                                            
                                            // Clear district dropdown
                                            districtSelect.innerHTML = '<option value="">Select District</option>';
                                            
                                            // Reset district selection
                                            districtSelect.value = '';
                                            
                                            if (selectedDivision && districtsData && districtsData.length > 0) {
                                                let foundCount = 0;
                                                districtsData.forEach(district => {
                                                    // Use case-insensitive comparison and trim whitespace
                                                    const districtDivision = district.division ? district.division.toString().trim() : '';
                                                    if (districtDivision && 
                                                        districtDivision.toLowerCase() === selectedDivision.toLowerCase()) {
                                                        const option = document.createElement('option');
                                                        option.value = district.name;
                                                        option.textContent = district.name;
                                                        option.setAttribute('data-district-id', district.id);
                                                        option.setAttribute('data-division', district.division);
                                                        districtSelect.appendChild(option);
                                                        foundCount++;
                                                    }
                                                });
                                                
                                                console.log('Found', foundCount, 'districts for division:', selectedDivision);
                                                
                                                // Debug log
                                                if (foundCount === 0) {
                                                    console.warn('No districts found for division:', selectedDivision);
                                                    console.log('Available divisions:', [...new Set(districtsData.map(d => d.division))]);
                                                }
                                            } else {
                                                console.warn('Cannot filter districts:', {
                                                    selectedDivision: selectedDivision,
                                                    hasDistrictsData: !!districtsData,
                                                    districtsDataLength: districtsData ? districtsData.length : 0
                                                });
                                            }
                                            
                                            // Update shipping and tax when division changes
                                            updateShippingAndTax();
                                        });
                                        
                                        // Update shipping and tax when district changes
                                        districtSelect.addEventListener('change', function() {
                                            updateShippingAndTax();
                                        });
                                    } else {
                                        console.error('Division or District select elements not found!', {
                                            divisionSelect: !!divisionSelect,
                                            districtSelect: !!districtSelect
                                        });
                                    }
                                    
                                    // Trigger division change if division is already selected
                                    if (divisionSelect.value) {
                                        divisionSelect.dispatchEvent(new Event('change'));
                                        // If district is selected, trigger district change after a delay
                                        setTimeout(() => {
                                            if (districtSelect.value) {
                                                districtSelect.dispatchEvent(new Event('change'));
                                            } else {
                                                // Even if no district, update shipping/tax based on division
                                                updateShippingAndTax();
                                            }
                                        }, 200);
                                    } else if (districtSelect.value) {
                                        // If only district is selected, update shipping/tax
                                        setTimeout(() => {
                                            updateShippingAndTax();
                                        }, 200);
                                    }
                                    
                                    // Make updateShippingAndTax available globally for debugging
                                    window.updateShippingAndTax = updateShippingAndTax;
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm checkout-order-summary">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-receipt me-2"></i>Order Summary
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Order Items -->
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-2">Items in your order:</h6>
                                @foreach($cart->items as $item)
                                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                        <div>
                                            <small class="fw-semibold">{{ $item->product->name }}</small>
                                            <br>
                                            <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                        </div>
                                        <div class="text-end">
                                            <small class="fw-semibold">@currency($item->line_total)</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Order Totals -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>@currency($cart->subtotal)</span>
                                </div>
                                @if($cart->coupon_discount > 0)
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-success">
                                            <i class="bi bi-ticket me-1"></i>Discount ({{ $cart->coupon->code }})
                                        </span>
                                        <span class="text-success">-@currency($cart->coupon_discount)</span>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tax</span>
                                    <span id="order-tax">@currency($cart->tax_total)</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Shipping</span>
                                    <span id="order-shipping">@currency($shipping ?? 0)</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="fw-bold fs-5">Total</span>
                                    <span class="fw-bold fs-5 text-primary" id="order-total">@currency($cart->grand_total + ($shipping ?? 0))</span>
                                </div>
                            </div>
                            
                            <!-- Place Order Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg btn-custom" id="place-order-btn">
                                    <i class="bi bi-check-circle me-2"></i>Place Order
                                </button>
                            </div>
                            
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="bi bi-shield-check me-1"></i>
                                    Your payment information is secure and encrypted
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to form submission
    const checkoutForm = document.querySelector('form[action="{{ route("checkout.place") }}"]');
    const placeOrderBtn = document.getElementById('place-order-btn');
    
    if (checkoutForm && placeOrderBtn) {
        checkoutForm.addEventListener('submit', function(e) {
            // Validate form before submission
            if (!this.checkValidity()) {
                e.preventDefault();
                this.reportValidity();
                return;
            }
            
            // Disable button and show loading state
            placeOrderBtn.disabled = true;
            placeOrderBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
            
            // Allow form to submit normally
        });
    }
});
</script>
@endpush
@endsection


