<div class="row g-3">
  <div class="col-md-4">
    <label for="code" class="form-label fw-semibold">Currency Code *</label>
    <input type="text" 
           class="form-control @error('code') is-invalid @enderror" 
           id="code" 
           name="code" 
           value="{{ old('code', $currency->code ?? '') }}" 
           placeholder="BDT" 
           maxlength="3"
           required>
    <small class="text-muted">3-letter code (e.g., BDT, USD, EUR)</small>
    @error('code')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  
  <div class="col-md-4">
    <label for="name" class="form-label fw-semibold">Currency Name *</label>
    <input type="text" 
           class="form-control @error('name') is-invalid @enderror" 
           id="name" 
           name="name" 
           value="{{ old('name', $currency->name ?? '') }}" 
           placeholder="Bangladeshi Taka" 
           required>
    @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  
  <div class="col-md-4">
    <label for="symbol" class="form-label fw-semibold">Symbol *</label>
    <input type="text" 
           class="form-control @error('symbol') is-invalid @enderror" 
           id="symbol" 
           name="symbol" 
           value="{{ old('symbol', $currency->symbol ?? '') }}" 
           placeholder="৳" 
           required>
    @error('symbol')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="row g-3 mt-3">
  <div class="col-md-6">
    <div class="form-check form-switch">
      <input class="form-check-input" 
             type="checkbox" 
             id="is_active" 
             name="is_active" 
             value="1" 
             {{ old('is_active', $currency->is_active ?? true) ? 'checked' : '' }}>
      <label class="form-check-label fw-semibold" for="is_active">
        Active
      </label>
      <small class="d-block text-muted">Only active currencies will be available</small>
    </div>
  </div>
  
  <div class="col-md-6">
    <div class="form-check form-switch">
      <input class="form-check-input" 
             type="checkbox" 
             id="is_default" 
             name="is_default" 
             value="1" 
             {{ old('is_default', $currency->is_default ?? false) ? 'checked' : '' }}>
      <label class="form-check-label fw-semibold" for="is_default">
        Set as Default
      </label>
      <small class="d-block text-muted">Only one currency can be default</small>
    </div>
  </div>
</div>
