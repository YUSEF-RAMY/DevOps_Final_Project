@extends('frontend.layouts.app')

@section('title', 'SMS OTP')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0"><i class="bi bi-phone me-2"></i>Request SMS OTP</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('otp.request.sms') }}">
            @csrf
            <div class="mb-3">
              <label for="phone" class="form-label">Phone number</label>
              <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="e.g., 01XXXXXXXXX" required>
              @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label for="purpose" class="form-label">Purpose</label>
              <input type="text" name="purpose" id="purpose" class="form-control" value="{{ old('purpose','login') }}">
            </div>
            <button class="btn btn-primary" type="submit"><i class="bi bi-send me-1"></i>Send OTP</button>
          </form>
        </div>
      </div>

      <div class="card border-0 shadow-sm">
        <div class="card-header bg-success text-white">
          <h5 class="mb-0"><i class="bi bi-shield-check me-2"></i>Verify SMS OTP</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('otp.verify.sms') }}">
            @csrf
            <div class="mb-3">
              <label for="verify_phone" class="form-label">Phone number</label>
              <input type="text" name="phone" id="verify_phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone ?? '') }}" required>
              @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label for="otp" class="form-label">OTP</label>
              <input type="text" name="otp" id="otp" class="form-control @error('otp') is-invalid @enderror" placeholder="Enter OTP code" pattern="[0-9]{4,8}" maxlength="8" required>
              @error('otp')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label for="verify_purpose" class="form-label">Purpose</label>
              <input type="text" name="purpose" id="verify_purpose" class="form-control" value="{{ old('purpose','login') }}">
            </div>
            <button class="btn btn-success" type="submit"><i class="bi bi-check-circle me-1"></i>Verify</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
