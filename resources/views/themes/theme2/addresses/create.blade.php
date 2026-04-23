@extends('themes.theme2.layouts.app')

@section('title', 'Add Address')

@section('content')
<div class="container py-5">
    <div class="mx-auto" style="max-width: 900px;">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h2 mb-0"><i class="bi bi-geo-fill me-2 text-primary"></i>Add New Address</h1>
            <a href="{{ route('addresses.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0"><i class="bi bi-geo-alt me-2"></i>Address Information</h2>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('addresses.store') }}" method="POST">
                    @csrf
                    
                    <!-- Address Type -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Address Type *</label>
                        <select name="type" required class="form-select @error('type') is-invalid @enderror">
                            <option value="">Select Address Type</option>
                            <option value="billing" {{ old('type') === 'billing' ? 'selected' : '' }}>Billing Address</option>
                            <option value="shipping" {{ old('type') === 'shipping' ? 'selected' : '' }}>Shipping Address</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Name Fields -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">First Name *</label>
                            <input name="first_name" type="text" required
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{ old('first_name') }}"
                                   placeholder="First Name">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Last Name *</label>
                            <input name="last_name" type="text" required
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{ old('last_name') }}"
                                   placeholder="Last Name">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone and Country -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input name="phone" type="tel"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}"
                                   placeholder="01XXXXXXXXX">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Country *</label>
                            <select name="country" required class="form-select @error('country') is-invalid @enderror">
                                <option value="Bangladesh" {{ old('country', 'Bangladesh') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                            </select>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Address *</label>
                        <input name="address_line_1" type="text" required
                               class="form-control @error('address_line_1') is-invalid @enderror"
                               value="{{ old('address_line_1') }}"
                               placeholder="Enter your address">
                        @error('address_line_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Division and District -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Division</label>
                            <select name="division" class="form-select @error('division') is-invalid @enderror" id="division">
                                <option value="">Select Division</option>
                                @php
                                    $selectedDivision = old('division', '');
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
                            @error('division')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">District</label>
                            <select name="district" class="form-select @error('district') is-invalid @enderror" id="district">
                                <option value="">Select District</option>
                                @php
                                    $selectedDistrict = old('district', '');
                                @endphp
                                @if($selectedDivision)
                                    @foreach($districts->where('division', $selectedDivision) as $district)
                                        <option value="{{ $district->name }}" 
                                            data-district-id="{{ $district->id }}"
                                            {{ $selectedDistrict == $district->name ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach($districts as $district)
                                        <option value="{{ $district->name }}" 
                                            data-district-id="{{ $district->id }}"
                                            data-division="{{ $district->division }}"
                                            {{ $selectedDistrict == $district->name ? 'selected' : '' }}>
                                            {{ $district->name }} ({{ $district->division }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('district')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Upazila and Postal Code -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Upazila/Thana</label>
                            <input name="upazila" type="text"
                                   class="form-control @error('upazila') is-invalid @enderror"
                                   value="{{ old('upazila') }}"
                                   placeholder="Upazila/Thana">
                            @error('upazila')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Postal Code</label>
                            <input name="postal_code" type="text"
                                   class="form-control @error('postal_code') is-invalid @enderror"
                                   value="{{ old('postal_code') }}"
                                   placeholder="Postal Code">
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Company (Optional) -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Company (Optional)</label>
                        <input name="company" type="text"
                               class="form-control @error('company') is-invalid @enderror"
                               value="{{ old('company') }}"
                               placeholder="Company Name">
                        @error('company')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Set as Default -->
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="1" id="is_default" name="is_default" {{ old('is_default') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_default">
                            Set as default {{ old('type', 'billing') }} address
                        </label>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('addresses.index') }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Save Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const divisionSelect = document.getElementById('division');
    const districtSelect = document.getElementById('district');
    
    // Districts data from server
    const districtsData = @json($districts->map(function($d) {
        return ['id' => $d->id, 'name' => $d->name, 'division' => $d->division];
    }));
    
    // Load districts when division changes
    divisionSelect.addEventListener('change', function() {
        const selectedDivision = this.value;
        districtSelect.innerHTML = '<option value="">Select District</option>';
        
        if (selectedDivision) {
            districtsData.forEach(district => {
                if (district.division === selectedDivision) {
                    const option = document.createElement('option');
                    option.value = district.name;
                    option.textContent = district.name;
                    option.setAttribute('data-district-id', district.id);
                    option.setAttribute('data-division', district.division);
                    districtSelect.appendChild(option);
                }
            });
        } else {
            // Show all districts with division names
            districtsData.forEach(district => {
                const option = document.createElement('option');
                option.value = district.name;
                option.textContent = district.name + ' (' + district.division + ')';
                option.setAttribute('data-district-id', district.id);
                option.setAttribute('data-division', district.division);
                districtSelect.appendChild(option);
            });
        }
    });
    
    // Trigger division change if division is already selected
    if (divisionSelect.value) {
        divisionSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
@endsection
