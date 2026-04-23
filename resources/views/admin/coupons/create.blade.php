@extends('admin.layouts.app')

@section('title', 'Create Coupon')

@section('content_header')
    <h1 class="h3 mb-0 text-gray-800">Create Coupon</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Coupon Details</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupons.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code" class="form-label">Coupon Code *</label>
                                    <input type="text" 
                                           class="form-control @error('code') is-invalid @enderror" 
                                           id="code" 
                                           name="code" 
                                           value="{{ old('code') }}" 
                                           placeholder="e.g., WELCOME10" 
                                           required>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Coupon Name *</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="e.g., Welcome Discount" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Optional description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type" class="form-label">Discount Type *</label>
                                    <select class="form-control @error('type') is-invalid @enderror" 
                                            id="type" 
                                            name="type" 
                                            required>
                                        <option value="">Select Type</option>
                                        <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="value" class="form-label">Discount Value *</label>
                                    <input type="number" 
                                           step="0.01" 
                                           min="0" 
                                           class="form-control @error('value') is-invalid @enderror" 
                                           id="value" 
                                           name="value" 
                                           value="{{ old('value') }}" 
                                           placeholder="e.g., 10" 
                                           required>
                                    @error('value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="min_order_amount" class="form-label">Minimum Order Amount</label>
                                    <input type="number" 
                                           step="0.01" 
                                           min="0" 
                                           class="form-control @error('min_order_amount') is-invalid @enderror" 
                                           id="min_order_amount" 
                                           name="min_order_amount" 
                                           value="{{ old('min_order_amount') }}" 
                                           placeholder="e.g., 50.00">
                                    @error('min_order_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="max_discount_amount" class="form-label">Maximum Discount Amount</label>
                                    <input type="number" 
                                           step="0.01" 
                                           min="0" 
                                           class="form-control @error('max_discount_amount') is-invalid @enderror" 
                                           id="max_discount_amount" 
                                           name="max_discount_amount" 
                                           value="{{ old('max_discount_amount') }}" 
                                           placeholder="e.g., 25.00">
                                    @error('max_discount_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usage_limit_per_coupon" class="form-label">Usage Limit (per coupon)</label>
                                    <input type="number" 
                                           min="1" 
                                           class="form-control @error('usage_limit_per_coupon') is-invalid @enderror" 
                                           id="usage_limit_per_coupon" 
                                           name="usage_limit_per_coupon" 
                                           value="{{ old('usage_limit_per_coupon') }}" 
                                           placeholder="e.g., 100">
                                    @error('usage_limit_per_coupon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usage_limit_per_user" class="form-label">Per User Limit</label>
                                    <input type="number" 
                                           min="1" 
                                           class="form-control @error('usage_limit_per_user') is-invalid @enderror" 
                                           id="usage_limit_per_user" 
                                           name="usage_limit_per_user" 
                                           value="{{ old('usage_limit_per_user') }}" 
                                           placeholder="e.g., 1">
                                    @error('usage_limit_per_user')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="starts_at" class="form-label">Start Date</label>
                                    <input type="date" 
                                           class="form-control @error('starts_at') is-invalid @enderror" 
                                           id="starts_at" 
                                           name="starts_at" 
                                           value="{{ old('starts_at') }}">
                                    @error('starts_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expires_at" class="form-label">Expiry Date</label>
                                    <input type="date" 
                                           class="form-control @error('expires_at') is-invalid @enderror" 
                                           id="expires_at" 
                                           name="expires_at" 
                                           value="{{ old('expires_at') }}">
                                    @error('expires_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check me-1"></i>Create Coupon
                            </button>
                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
