@extends('themes.theme3.layouts.app')

@section('title', 'Checkout')

@push('styles')
<style>
    @media (min-width: 992px) {
        .checkout-order-summary {
            position: sticky;
            top: 100px;
            z-index: 100;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-decoration-none">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Checkout Section -->
<section class="py-5">
    <div class="container">
        @if($cart->items->count() === 0)
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body py-5">
                            <i class="fas fa-cart-x fa-3x text-muted mb-4"></i>
                            <h3 class="text-muted mb-3">Your cart is empty</h3>
                            <p class="text-muted mb-4">You need to add items to your cart before proceeding to checkout.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-shopping-bag me-2"></i>Start Shopping
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
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0 fw-bold"><i class="fas fa-map-marker-alt text-primary me-2"></i>Delivery Address</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="billing_name" class="form-label fw-semibold">Full Name *</label>
                                        <input type="text" class="form-control @error('billing_name') is-invalid @enderror" id="billing_name" name="billing_name" value="{{ old('billing_name') ?: ($defaultBillingAddress ? trim($defaultBillingAddress->first_name . ' ' . $defaultBillingAddress->last_name) : (auth()->user()->name ?? '')) }}" placeholder="Enter your full name" required>
                                        @error('billing_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="billing_email" class="form-label fw-semibold">Email Address *</label>
                                        <input type="email" class="form-control @error('billing_email') is-invalid @enderror" id="billing_email" name="billing_email" value="{{ old('billing_email', auth()->user()->email ?? '') }}" placeholder="Enter your email" required>
                                        @error('billing_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="billing_phone" class="form-label fw-semibold">Phone Number *</label>
                                        <input type="tel" class="form-control @error('billing_phone') is-invalid @enderror" id="billing_phone" name="billing_phone" value="{{ old('billing_phone') ?: ($defaultBillingAddress ? $defaultBillingAddress->phone : (auth()->user()->phone ?? '')) }}" placeholder="01XXXXXXXXX" required>
                                        @error('billing_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="billing_country" class="form-label fw-semibold">Country</label>
                                        <select class="form-select @error('billing_country') is-invalid @enderror" id="billing_country" name="billing_country">
                                            @php
                                                $billingCountry = old('billing_country') ?: ($defaultBillingAddress ? $defaultBillingAddress->country : 'Bangladesh');
                                            @endphp
                                            <option value="Bangladesh" {{ $billingCountry == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                        </select>
                                        @error('billing_country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="billing_address" class="form-label fw-semibold">Address</label>
                                        <input type="text" class="form-control @error('billing_address') is-invalid @enderror" id="billing_address" name="billing_address" value="{{ old('billing_address') ?: ($defaultBillingAddress ? trim($defaultBillingAddress->address_line_1 . ($defaultBillingAddress->address_line_2 ? ', ' . $defaultBillingAddress->address_line_2 : '')) : '') }}" placeholder="Enter your address">
                                        @error('billing_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="billing_division" class="form-label fw-semibold">Division</label>
                                        <select class="form-select @error('billing_division') is-invalid @enderror" id="billing_division" name="billing_division">
                                            <option value="">Select Division</option>
                                            @php
                                                $selectedDivision = old('billing_division') ?: ($defaultBillingAddress && $defaultBillingAddress->division ? $defaultBillingAddress->division : '');
                                            @endphp
                                            @foreach($divisions as $division)
                                                <option value="{{ $division }}" {{ $selectedDivision == $division ? 'selected' : '' }}>{{ $division }}</option>
                                            @endforeach
                                        </select>
                                        @error('billing_division')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="billing_district" class="form-label fw-semibold">District</label>
                                        <select class="form-select @error('billing_district') is-invalid @enderror" id="billing_district" name="billing_district">
                                            <option value="">Select District</option>
                                            @php
                                                $selectedDistrict = old('billing_district') ?: ($defaultBillingAddress && $defaultBillingAddress->district ? $defaultBillingAddress->district : '');
                                            @endphp
                                            @if($selectedDivision)
                                                @foreach($districts->where('division', $selectedDivision) as $district)
                                                    <option value="{{ $district->name }}" data-district-id="{{ $district->id }}" data-division="{{ $district->division }}" {{ $selectedDistrict == $district->name ? 'selected' : '' }}>
                                                        {{ $district->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('billing_district')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="billing_upazila" class="form-label fw-semibold">Upazila/Thana</label>
                                        <input type="text" class="form-control @error('billing_upazila') is-invalid @enderror" id="billing_upazila" name="billing_upazila" value="{{ old('billing_upazila') ?: ($defaultBillingAddress && $defaultBillingAddress->upazila ? $defaultBillingAddress->upazila : '') }}" placeholder="Upazila/Thana">
                                        @error('billing_upazila')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="billing_postcode" class="form-label fw-semibold">Postal Code</label>
                                        <input type="text" class="form-control @error('billing_postcode') is-invalid @enderror" id="billing_postcode" name="billing_postcode" value="{{ old('billing_postcode') ?: ($defaultBillingAddress ? $defaultBillingAddress->postal_code : '') }}" placeholder="Postal Code">
                                        @error('billing_postcode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0 fw-bold"><i class="fas fa-credit-card text-primary me-2"></i>Payment Method</h5>
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
                                        <i class="fas fa-exclamation-triangle me-2"></i>No payment gateways are enabled. Please contact support.
                                    </div>
                                @endif
                                
                                <div class="row g-3">
                                    @if($hasCod)
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-3 h-100">
                                                <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_cod" value="cod" {{ old('gateway', (!$hasBkash && !$hasNagad && !$hasRocket && !$hasSslCommerce) ? 'cod' : '') === 'cod' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gateway_cod">
                                                    <i class="fas fa-truck me-2"></i>Cash on Delivery
                                                </label>
                                                <div class="text-muted small mt-2">Pay with cash upon delivery.</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($hasBkash)
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-3 h-100">
                                                <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_bkash" value="bkash" {{ old('gateway') === 'bkash' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gateway_bkash">
                                                    <i class="fas fa-mobile-alt me-2"></i>bKash
                                                </label>
                                                <div class="text-muted small mt-2">You will be redirected to bKash payment page.</div>
                                                @if(($gatewaySandboxModes['bkash'] ?? true))
                                                    <span class="badge bg-info mt-1">Sandbox Mode</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if($hasNagad)
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-3 h-100">
                                                <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_nagad" value="nagad" {{ old('gateway') === 'nagad' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gateway_nagad">
                                                    <i class="fas fa-mobile-alt me-2"></i>Nagad
                                                </label>
                                                <div class="text-muted small mt-2">You will be redirected to Nagad payment page.</div>
                                                @if(($gatewaySandboxModes['nagad'] ?? true))
                                                    <span class="badge bg-info mt-1">Sandbox Mode</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if($hasRocket)
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-3 h-100">
                                                <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_rocket" value="rocket" {{ old('gateway') === 'rocket' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gateway_rocket">
                                                    <i class="fas fa-mobile-alt me-2"></i>Rocket
                                                </label>
                                                <div class="text-muted small mt-2">You will be redirected to Rocket payment page.</div>
                                                @if(($gatewaySandboxModes['rocket'] ?? true))
                                                    <span class="badge bg-info mt-1">Sandbox Mode</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if($hasSslCommerce)
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-3 h-100">
                                                <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_ssl_commerce" value="ssl_commerce" {{ old('gateway') === 'ssl_commerce' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gateway_ssl_commerce">
                                                    <i class="fas fa-credit-card me-2"></i>SSL Commerce
                                                </label>
                                                <div class="text-muted small mt-2">Pay securely with card, mobile banking, or bank transfer.</div>
                                                @if(($gatewaySandboxModes['ssl_commerce'] ?? true))
                                                    <span class="badge bg-info mt-1">Sandbox Mode</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if($hasStripe)
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-3 h-100">
                                                <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_stripe" value="stripe" {{ old('gateway') === 'stripe' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gateway_stripe">
                                                    <i class="fab fa-stripe me-2"></i>Stripe
                                                </label>
                                                <div class="text-muted small mt-2">Pay securely with your card via Stripe.</div>
                                                @if(($gatewaySandboxModes['stripe'] ?? true))
                                                    <span class="badge bg-info mt-1">Test Mode</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if($hasPaypal)
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-3 h-100">
                                                <input class="form-check-input payment-gateway-radio" type="radio" name="gateway" id="gateway_paypal" value="paypal" {{ old('gateway') === 'paypal' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gateway_paypal">
                                                    <i class="fab fa-paypal me-2"></i>PayPal
                                                </label>
                                                <div class="text-muted small mt-2">Checkout quickly with your PayPal account.</div>
                                                @if(($gatewaySandboxModes['paypal'] ?? true))
                                                    <span class="badge bg-info mt-1">Sandbox Mode</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                @error('gateway')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm border-0 checkout-order-summary">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0 fw-bold">Order Summary</h5>
                            </div>
                            <div class="card-body">
                                <!-- Coupon Section -->
                                <div class="mb-4">
                                    <h6 class="fw-semibold mb-2">
                                        <i class="fas fa-ticket me-1"></i>Coupon Code
                                    </h6>
                                    @if($cart->coupon)
                                        <div class="alert alert-success py-2 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>{{ $cart->coupon->code }}</strong>
                                                    <br>
                                                    <small>{{ $cart->coupon->name }}</small>
                                                </div>
                                                <form action="{{ route('coupons.remove') }}" method="post" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <div id="couponForm" class="d-flex gap-2">
                                            <input type="text" 
                                                   id="couponCode" 
                                                   class="form-control form-control-sm" 
                                                   placeholder="Enter coupon code"
                                                   maxlength="50">
                                            <button type="button" id="applyCouponBtn" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>
                                        <div id="couponMessage" class="mt-2"></div>
                                    @endif
                                </div>

                                <!-- Order Items -->
                                <div class="mb-3">
                                    <h6 class="fw-semibold mb-2">Items in your order:</h6>
                                    @foreach($cart->items as $item)
                                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                            <div>
                                                <small class="fw-semibold">{{ $item->product->name ?? 'Product' }}</small>
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
                                        <span id="order-subtotal">@currency($cart->subtotal)</span>
                                    </div>
                                    @if($cart->coupon_discount > 0)
                                        <div class="d-flex justify-content-between mb-2" id="order-discount-row">
                                            <span class="text-success">
                                                <i class="fas fa-ticket me-1"></i>Discount ({{ $cart->coupon->code ?? '' }})
                                            </span>
                                            <span class="text-success" id="order-discount">-@currency($cart->coupon_discount)</span>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-between mb-2 d-none" id="order-discount-row">
                                            <span class="text-success">
                                                <i class="fas fa-ticket me-1"></i>Discount
                                            </span>
                                            <span class="text-success" id="order-discount">-@currency(0)</span>
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
                                        <span class="fw-bold fs-5 text-primary" id="order-total">@currency(($cart->subtotal - $cart->coupon_discount) + $cart->tax_total + ($shipping ?? 0))</span>
                                    </div>
                                </div>
                                
                                <!-- Place Order Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary w-100 btn-lg" id="place-order-btn">
                                        <i class="fas fa-check-circle me-2"></i>Place Order
                                    </button>
                                </div>
                                
                                <div class="text-center mt-3">
                                    <small class="text-muted">
                                        <i class="fas fa-shield-alt me-1"></i>
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
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // District dynamic loading
    const divisionSelect = document.getElementById('billing_division');
    const districtSelect = document.getElementById('billing_district');
    
    // Districts data from server
    const districtsData = @json($districts->map(function($d) {
        return ['id' => $d->id, 'name' => $d->name, 'division' => $d->division];
    }));
    
    // Currency formatting
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
        return CURRENCY.symbol_first 
            ? (sign + CURRENCY.symbol + intPart + frac).replace('--','-') 
            : (intPart + frac + ' ' + CURRENCY.symbol).trim();
    }
    
    // Function to calculate and update shipping/tax
    function updateShippingAndTax() {
        let division = divisionSelect.value;
        let district = districtSelect.value;
        
        if (!division && district) {
            const selectedOption = districtSelect.options[districtSelect.selectedIndex];
            const districtDivision = selectedOption?.getAttribute('data-division');
            if (districtDivision) {
                division = districtDivision;
            }
        }
        
        const taxElement = document.getElementById('order-tax');
        const shippingElement = document.getElementById('order-shipping');
        const totalElement = document.getElementById('order-total');
        
        if (!taxElement || !shippingElement || !totalElement) return;
        
        if (!division && !district) {
            const originalTax = taxElement.getAttribute('data-original');
            const originalShipping = shippingElement.getAttribute('data-original');
            const originalTotal = totalElement.getAttribute('data-original');
            
            if (originalTax) taxElement.textContent = originalTax;
            if (originalShipping) shippingElement.textContent = originalShipping;
            if (originalTotal) totalElement.textContent = originalTotal;
            return;
        }
        
        if (!taxElement.getAttribute('data-original')) {
            taxElement.setAttribute('data-original', taxElement.textContent);
        }
        if (!shippingElement.getAttribute('data-original')) {
            shippingElement.setAttribute('data-original', shippingElement.textContent);
        }
        if (!totalElement.getAttribute('data-original')) {
            totalElement.setAttribute('data-original', totalElement.textContent);
        }
        
        taxElement.textContent = '...';
        shippingElement.textContent = '...';
        totalElement.textContent = '...';
        
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
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                taxElement.textContent = formatCurrency(data.tax);
                shippingElement.textContent = formatCurrency(data.shipping);
                // Use the total from server response which already includes discount, tax, and shipping
                totalElement.textContent = formatCurrency(data.total);
            } else {
                taxElement.textContent = taxElement.getAttribute('data-original') || formatCurrency(0);
                shippingElement.textContent = shippingElement.getAttribute('data-original') || formatCurrency(0);
                totalElement.textContent = totalElement.getAttribute('data-original') || formatCurrency(0);
            }
        })
        .catch(error => {
            console.error('Error calculating shipping/tax:', error);
            taxElement.textContent = taxElement.getAttribute('data-original') || formatCurrency(0);
            shippingElement.textContent = shippingElement.getAttribute('data-original') || formatCurrency(0);
            totalElement.textContent = totalElement.getAttribute('data-original') || formatCurrency(0);
        });
    }
    
    // Load districts when division changes
    if (divisionSelect && districtSelect) {
        divisionSelect.addEventListener('change', function() {
            const selectedDivision = this.value.trim();
            districtSelect.innerHTML = '<option value="">Select District</option>';
            districtSelect.value = '';
            
            if (selectedDivision && districtsData && districtsData.length > 0) {
                districtsData.forEach(district => {
                    const districtDivision = district.division ? district.division.toString().trim() : '';
                    if (districtDivision && districtDivision.toLowerCase() === selectedDivision.toLowerCase()) {
                        const option = document.createElement('option');
                        option.value = district.name;
                        option.textContent = district.name;
                        option.setAttribute('data-district-id', district.id);
                        option.setAttribute('data-division', district.division);
                        districtSelect.appendChild(option);
                    }
                });
            }
            updateShippingAndTax();
        });
        
        districtSelect.addEventListener('change', function() {
            updateShippingAndTax();
        });
        
        // Trigger division change if division is already selected
        if (divisionSelect.value) {
            divisionSelect.dispatchEvent(new Event('change'));
            setTimeout(() => {
                if (districtSelect.value) {
                    districtSelect.dispatchEvent(new Event('change'));
                } else {
                    updateShippingAndTax();
                }
            }, 200);
        } else if (districtSelect.value) {
            setTimeout(() => {
                updateShippingAndTax();
            }, 200);
        }
    }
    
    // Coupon functionality
    const couponForm = document.getElementById('couponForm');
    const couponCode = document.getElementById('couponCode');
    const couponMessage = document.getElementById('couponMessage');
    const applyCouponBtn = document.getElementById('applyCouponBtn');
    
    function showCouponMessage(message, type) {
        if (!couponMessage) return;
        couponMessage.innerHTML = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;
        setTimeout(() => {
            const alert = couponMessage.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 150);
            }
        }, 5000);
    }
    
    function applyCoupon() {
        if (!couponCode || !applyCouponBtn) return;
        
        const code = couponCode.value.trim();
        if (!code) {
            showCouponMessage('Please enter a coupon code.', 'danger');
            return;
        }
        
        const originalText = applyCouponBtn.innerHTML;
        applyCouponBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        applyCouponBtn.disabled = true;
            
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                         document.querySelector('input[name="_token"]')?.value;
        
        if (!csrfToken) {
            showCouponMessage('CSRF token not found. Please refresh the page.', 'danger');
            applyCouponBtn.innerHTML = originalText;
            applyCouponBtn.disabled = false;
            return;
        }
        
        fetch('{{ route("coupons.apply") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ code: code }),
            credentials: 'same-origin'
        })
        .then(response => {
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json().then(data => ({
                    ok: response.ok,
                    status: response.status,
                    data: data
                }));
            } else {
                return {
                    ok: false,
                    status: response.status,
                    data: {
                        message: response.status === 419 
                            ? 'Your session has expired. Please refresh the page.' 
                            : 'An error occurred. Please try again.'
                    }
                };
            }
        })
        .then(result => {
            if (result.status === 419) {
                showCouponMessage('Your session has expired. Refreshing page...', 'warning');
                setTimeout(() => window.location.reload(), 2000);
                return;
            }
            
            if (result.ok && result.data.success) {
                showCouponMessage(result.data.message || 'Coupon applied successfully!', 'success');
                setTimeout(() => window.location.reload(), 1500);
            } else {
                const errorMessage = result.data.message || result.data.error || 'An error occurred. Please try again.';
                showCouponMessage(errorMessage, 'danger');
                applyCouponBtn.innerHTML = originalText;
                applyCouponBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Coupon error:', error);
            showCouponMessage('An error occurred. Please try again.', 'danger');
            applyCouponBtn.innerHTML = originalText;
            applyCouponBtn.disabled = false;
        });
    }
    
    // Attach event listeners
    if (applyCouponBtn) {
        applyCouponBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            applyCoupon();
        });
    }
    
    // Also handle Enter key in coupon input
    if (couponCode) {
        couponCode.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                e.stopPropagation();
                applyCoupon();
            }
        });
    }
    
    // Update totals when shipping/tax changes (including coupon discount)
    function updateOrderTotals() {
        const subtotalEl = document.getElementById('order-subtotal');
        const discountEl = document.getElementById('order-discount');
        const discountRow = document.getElementById('order-discount-row');
        const taxEl = document.getElementById('order-tax');
        const shippingEl = document.getElementById('order-shipping');
        const totalEl = document.getElementById('order-total');
        
        if (!subtotalEl || !taxEl || !shippingEl || !totalEl) return;
        
        // Get current values
        const subtotal = parseFloat(subtotalEl.textContent.replace(/[^\d.-]/g, '')) || 0;
        const discount = discountEl ? (parseFloat(discountEl.textContent.replace(/[^\d.-]/g, '')) || 0) : 0;
        const tax = parseFloat(taxEl.textContent.replace(/[^\d.-]/g, '')) || 0;
        const shipping = parseFloat(shippingEl.textContent.replace(/[^\d.-]/g, '')) || 0;
        
        // Calculate total
        const total = subtotal - discount + tax + shipping;
        totalEl.textContent = formatCurrency(total);
    }
    
    // Watch for changes in shipping/tax to update total
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' || mutation.type === 'characterData') {
                updateOrderTotals();
            }
        });
    });
    
    const taxElement = document.getElementById('order-tax');
    const shippingElement = document.getElementById('order-shipping');
    if (taxElement) observer.observe(taxElement, { childList: true, characterData: true, subtree: true });
    if (shippingElement) observer.observe(shippingElement, { childList: true, characterData: true, subtree: true });
});
</script>
@endpush
