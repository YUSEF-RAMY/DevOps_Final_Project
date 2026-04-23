@extends('admin.layouts.app')

@section('title', 'Shipping & Tax Settings')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white border-bottom">
        <h3 class="card-title mb-0 fw-semibold">Shipping & Tax Settings</h3>
    </div>
    <div class="card-body p-3">

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
  <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
  <i class="bi bi-exclamation-triangle me-2"></i>Please fix the errors below.
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form method="post" action="{{ route('admin.shipping-settings.update') }}">
  @csrf
  @method('PUT')
  
  <!-- Shipping Settings -->
  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white border-bottom">
      <h5 class="mb-0 fw-semibold"><i class="bi bi-truck me-2"></i>Shipping Charges</h5>
    </div>
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="enabled" name="enabled" value="1" {{ ($settings->enabled ?? false) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="enabled">Enable Shipping</label>
          </div>
        </div>
        <div class="col-md-6">
          <label class="form-label">Default Flat Rate (BDT)</label>
          <input type="number" step="0.01" name="flat_rate" class="form-control" value="{{ old('flat_rate', $settings->flat_rate ?? 0) }}" placeholder="0.00">
        </div>
        <div class="col-md-6">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="free_shipping_enabled" name="free_shipping_enabled" value="1" {{ ($settings->free_shipping_enabled ?? false) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="free_shipping_enabled">Enable Free Shipping</label>
          </div>
        </div>
        <div class="col-md-6">
          <label class="form-label">Free Shipping Minimum (BDT)</label>
          <input type="number" step="0.01" name="free_shipping_min_total" class="form-control" value="{{ old('free_shipping_min_total', $settings->free_shipping_min_total ?? 0) }}" placeholder="0.00" required>
        </div>
      </div>
      
      <hr class="my-4">
      
      <h6 class="fw-semibold mb-3">Division Rates</h6>
      <div id="divisionRates" class="mb-3">
        @php($rates = $settings->division_rates ?? [])
        @if(count($rates) > 0)
          @foreach($rates as $index => $conf)
          <div class="row g-2 mb-2">
            <div class="col-md-4">
              <select name="division_rates[{{ $index }}][division]" class="form-select form-select-sm">
                <option value="">Select Division</option>
                <option value="Dhaka" {{ ($conf['division'] ?? '')=='Dhaka'?'selected':'' }}>Dhaka</option>
                <option value="Chittagong" {{ ($conf['division'] ?? '')=='Chittagong'?'selected':'' }}>Chittagong</option>
                <option value="Rajshahi" {{ ($conf['division'] ?? '')=='Rajshahi'?'selected':'' }}>Rajshahi</option>
                <option value="Khulna" {{ ($conf['division'] ?? '')=='Khulna'?'selected':'' }}>Khulna</option>
                <option value="Barisal" {{ ($conf['division'] ?? '')=='Barisal'?'selected':'' }}>Barisal</option>
                <option value="Sylhet" {{ ($conf['division'] ?? '')=='Sylhet'?'selected':'' }}>Sylhet</option>
                <option value="Rangpur" {{ ($conf['division'] ?? '')=='Rangpur'?'selected':'' }}>Rangpur</option>
                <option value="Mymensingh" {{ ($conf['division'] ?? '')=='Mymensingh'?'selected':'' }}>Mymensingh</option>
              </select>
            </div>
            <div class="col-md-2">
              <select name="division_rates[{{ $index }}][type]" class="form-select form-select-sm">
                <option value="flat" {{ ($conf['type'] ?? 'flat')==='flat'?'selected':'' }}>Flat</option>
                <option value="percent" {{ ($conf['type'] ?? '')==='percent'?'selected':'' }}>Percent</option>
              </select>
            </div>
            <div class="col-md-4">
              <input type="number" step="0.01" name="division_rates[{{ $index }}][amount]" class="form-control form-control-sm" value="{{ $conf['amount'] ?? 0 }}" placeholder="Amount">
            </div>
            <div class="col-md-2">
              <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="this.closest('.row').remove();">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </div>
          @endforeach
        @endif
      </div>
      <button type="button" class="btn btn-sm btn-outline-primary" onclick="addDivisionRateRow();">
        <i class="bi bi-plus-circle me-1"></i>Add Division Rate
      </button>
      
      <hr class="my-4">
      
      <h6 class="fw-semibold mb-3">District Rates</h6>
      <div id="districtRates" class="mb-3">
        @php($rates = $settings->district_rates ?? [])
        @if(count($rates) > 0)
          @foreach($rates as $index => $conf)
          <div class="row g-2 mb-2">
            <div class="col-md-4">
              <input type="text" name="district_rates[{{ $index }}][district]" class="form-control form-control-sm" value="{{ $conf['district'] ?? '' }}" placeholder="District name">
            </div>
            <div class="col-md-2">
              <select name="district_rates[{{ $index }}][type]" class="form-select form-select-sm">
                <option value="flat" {{ ($conf['type'] ?? 'flat')==='flat'?'selected':'' }}>Flat</option>
                <option value="percent" {{ ($conf['type'] ?? '')==='percent'?'selected':'' }}>Percent</option>
              </select>
            </div>
            <div class="col-md-4">
              <input type="number" step="0.01" name="district_rates[{{ $index }}][amount]" class="form-control form-control-sm" value="{{ $conf['amount'] ?? 0 }}" placeholder="Amount">
            </div>
            <div class="col-md-2">
              <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="this.closest('.row').remove();">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </div>
          @endforeach
        @endif
      </div>
      <button type="button" class="btn btn-sm btn-outline-primary" onclick="addDistrictRateRow();">
        <i class="bi bi-plus-circle me-1"></i>Add District Rate
      </button>
    </div>
  </div>

  <!-- Tax Settings -->
  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white border-bottom">
      <h5 class="mb-0 fw-semibold"><i class="bi bi-receipt me-2"></i>Tax Information</h5>
    </div>
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-4">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="tax_enabled" name="tax_enabled" value="1" {{ ($settings->tax_enabled ?? false) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="tax_enabled">Enable Tax</label>
          </div>
        </div>
        <div class="col-md-4">
          <label class="form-label">Tax Type</label>
          <select name="tax_type" class="form-select">
            <option value="percent" {{ ($settings->tax_type ?? 'percent')==='percent'?'selected':'' }}>Percentage</option>
            <option value="flat" {{ ($settings->tax_type ?? '')==='flat'?'selected':'' }}>Flat Amount</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Tax Rate (BDT or %)</label>
          <input type="number" step="0.01" name="tax_rate" class="form-control" value="{{ old('tax_rate', $settings->tax_rate ?? 0) }}" placeholder="0.00">
        </div>
      </div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="d-flex justify-content-end gap-2 mt-3">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">
      <i class="bi bi-save me-1"></i>Save Settings
    </button>
  </div>
</form>
    </div>
</div>

@push('scripts')
<script>
let divisionRateIndex = {{ count($settings->division_rates ?? []) }};
let districtRateIndex = {{ count($settings->district_rates ?? []) }};

function addDivisionRateRow(){
  const container = document.getElementById('divisionRates');
  const div = document.createElement('div');
  div.className = 'row g-2 mb-2';
  div.innerHTML = `
    <div class="col-md-4">
      <select name="division_rates[${divisionRateIndex}][division]" class="form-select form-select-sm">
        <option value="">Select Division</option>
        <option value="Dhaka">Dhaka</option>
        <option value="Chittagong">Chittagong</option>
        <option value="Rajshahi">Rajshahi</option>
        <option value="Khulna">Khulna</option>
        <option value="Barisal">Barisal</option>
        <option value="Sylhet">Sylhet</option>
        <option value="Rangpur">Rangpur</option>
        <option value="Mymensingh">Mymensingh</option>
      </select>
    </div>
    <div class="col-md-2">
      <select name="division_rates[${divisionRateIndex}][type]" class="form-select form-select-sm">
        <option value="flat">Flat</option>
        <option value="percent">Percent</option>
      </select>
    </div>
    <div class="col-md-4">
      <input type="number" step="0.01" name="division_rates[${divisionRateIndex}][amount]" class="form-control form-control-sm" placeholder="Amount">
    </div>
    <div class="col-md-2">
      <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="this.closest('.row').remove();">
        <i class="bi bi-trash"></i>
      </button>
    </div>
  `;
  container.appendChild(div);
  divisionRateIndex++;
}

function addDistrictRateRow(){
  const container = document.getElementById('districtRates');
  const div = document.createElement('div');
  div.className = 'row g-2 mb-2';
  div.innerHTML = `
    <div class="col-md-4">
      <input type="text" name="district_rates[${districtRateIndex}][district]" class="form-control form-control-sm" placeholder="District name">
    </div>
    <div class="col-md-2">
      <select name="district_rates[${districtRateIndex}][type]" class="form-select form-select-sm">
        <option value="flat">Flat</option>
        <option value="percent">Percent</option>
      </select>
    </div>
    <div class="col-md-4">
      <input type="number" step="0.01" name="district_rates[${districtRateIndex}][amount]" class="form-control form-control-sm" placeholder="Amount">
    </div>
    <div class="col-md-2">
      <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="this.closest('.row').remove();">
        <i class="bi bi-trash"></i>
      </button>
    </div>
  `;
  container.appendChild(div);
  districtRateIndex++;
}
</script>
@endpush
@endsection
