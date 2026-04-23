@extends('admin.layouts.app')

@section('title', 'Edit Coupon')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><i class="bi bi-ticket-perforated me-2"></i>Edit Coupon</h1>
    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-header">
      <h5 class="mb-0">Coupon Details</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
          <div class="col-md-6">
            <label for="code" class="form-label">Coupon Code *</label>
            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $coupon->code) }}" required placeholder="e.g., WELCOME10">
            @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-6">
            <label for="name" class="form-label">Coupon Name *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $coupon->name) }}" required placeholder="e.g., Welcome Discount">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="mt-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Optional description">{{ old('description', $coupon->description) }}</textarea>
          @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row g-3 mt-1">
          <div class="col-md-4">
            <label for="type" class="form-label">Discount Type *</label>
            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
              <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
              <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
            </select>
            @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-4">
            <label for="value" class="form-label">Discount Value *</label>
            <input type="number" step="0.01" min="0" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $coupon->value) }}" required placeholder="e.g., 10">
            @error('value')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-4">
            <label for="max_discount_amount" class="form-label">Maximum Discount Amount</label>
            <input type="number" step="0.01" min="0" class="form-control @error('max_discount_amount') is-invalid @enderror" id="max_discount_amount" name="max_discount_amount" value="{{ old('max_discount_amount', $coupon->max_discount_amount) }}" placeholder="e.g., 25.00">
            @error('max_discount_amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-md-4">
            <label for="min_order_amount" class="form-label">Minimum Order Amount</label>
            <input type="number" step="0.01" min="0" class="form-control @error('min_order_amount') is-invalid @enderror" id="min_order_amount" name="min_order_amount" value="{{ old('min_order_amount', $coupon->min_order_amount) }}" placeholder="e.g., 50.00">
            @error('min_order_amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-4">
            <label for="usage_limit_per_coupon" class="form-label">Usage Limit (per coupon)</label>
            <input type="number" min="0" class="form-control @error('usage_limit_per_coupon') is-invalid @enderror" id="usage_limit_per_coupon" name="usage_limit_per_coupon" value="{{ old('usage_limit_per_coupon', $coupon->usage_limit_per_coupon) }}" placeholder="e.g., 100">
            @error('usage_limit_per_coupon')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-4">
            <label for="usage_limit_per_user" class="form-label">Per User Limit</label>
            <input type="number" min="0" class="form-control @error('usage_limit_per_user') is-invalid @enderror" id="usage_limit_per_user" name="usage_limit_per_user" value="{{ old('usage_limit_per_user', $coupon->usage_limit_per_user) }}" placeholder="e.g., 1">
            @error('usage_limit_per_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-md-6">
            <label for="starts_at" class="form-label">Start Date</label>
            <input type="date" class="form-control @error('starts_at') is-invalid @enderror" id="starts_at" name="starts_at" value="{{ old('starts_at', optional($coupon->starts_at)->format('Y-m-d')) }}">
            @error('starts_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-6">
            <label for="expires_at" class="form-label">Expiry Date</label>
            <input type="date" class="form-control @error('expires_at') is-invalid @enderror" id="expires_at" name="expires_at" value="{{ old('expires_at', optional($coupon->expires_at)->format('Y-m-d')) }}">
            @error('expires_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="form-check mt-3">
          <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}>
          <label class="form-check-label" for="is_active">Active</label>
        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Update Coupon</button>
          <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
