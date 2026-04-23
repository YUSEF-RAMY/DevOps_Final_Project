@extends('admin.layouts.app')

@section('title', 'Coin Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  </div>

<div class="card">
  <div class="card-body">
    <form method="post" action="{{ route('admin.coin-settings.update') }}" class="row g-3">
      @csrf
      @method('PUT')
      <div class="col-12">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="coins_enabled" name="coins_enabled" value="1" {{ $settings->coins_enabled ? 'checked' : '' }}>
          <label class="form-check-label" for="coins_enabled">Enable Coins System</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="add_to_cart_enabled" name="add_to_cart_enabled" value="1" {{ $settings->add_to_cart_enabled ? 'checked' : '' }}>
          <label class="form-check-label" for="add_to_cart_enabled">Enable Add-to-Cart Rewards</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="order_award_enabled" name="order_award_enabled" value="1" {{ $settings->order_award_enabled ? 'checked' : '' }}>
          <label class="form-check-label" for="order_award_enabled">Enable Order Rewards</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="referral_enabled" name="referral_enabled" value="1" {{ $settings->referral_enabled ? 'checked' : '' }}>
          <label class="form-check-label" for="referral_enabled">Enable Referral Bonus</label>
        </div>
      </div>
      <div class="col-md-4">
        <label class="form-label">Add to Cart Award</label>
        <input type="number" name="add_to_cart_award" class="form-control @error('add_to_cart_award') is-invalid @enderror" value="{{ old('add_to_cart_award', $settings->add_to_cart_award) }}">
        @error('add_to_cart_award')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-4">
        <label class="form-label">Add to Cart Daily Cap</label>
        <input type="number" name="add_to_cart_daily_cap" class="form-control @error('add_to_cart_daily_cap') is-invalid @enderror" value="{{ old('add_to_cart_daily_cap', $settings->add_to_cart_daily_cap) }}">
        @error('add_to_cart_daily_cap')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-4">
        <label class="form-label">Order Rate (currency per step)</label>
        <input type="number" name="order_rate_per" class="form-control @error('order_rate_per') is-invalid @enderror" value="{{ old('order_rate_per', $settings->order_rate_per) }}">
        @error('order_rate_per')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-4">
        <label class="form-label">Order Coins per Step</label>
        <input type="number" name="order_rate_coins" class="form-control @error('order_rate_coins') is-invalid @enderror" value="{{ old('order_rate_coins', $settings->order_rate_coins) }}">
        @error('order_rate_coins')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-4">
        <label class="form-label">Order Minimum Award</label>
        <input type="number" name="order_min_award" class="form-control @error('order_min_award') is-invalid @enderror" value="{{ old('order_min_award', $settings->order_min_award) }}">
        @error('order_min_award')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-4">
        <label class="form-label">COD Bonus</label>
        <input type="number" name="cod_bonus" class="form-control @error('cod_bonus') is-invalid @enderror" value="{{ old('cod_bonus', $settings->cod_bonus) }}">
        @error('cod_bonus')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-4">
        <label class="form-label">Referral Signup Bonus</label>
        <input type="number" name="referral_signup_bonus" class="form-control @error('referral_signup_bonus') is-invalid @enderror" value="{{ old('referral_signup_bonus', $settings->referral_signup_bonus) }}">
        @error('referral_signup_bonus')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-12">
        <button class="btn btn-primary"><i class="bi bi-save me-1"></i>Save</button>
      </div>
    </form>
  </div>
</div>
@endsection


