@extends('themes.theme2.layouts.app')

@section('title', 'Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-plus-circle text-primary display-1"></i>
                        <h2 class="fw-bold mt-3">Create Account</h2>
                        <p class="text-muted">Join us today and start shopping!</p>
                    </div>

                    @if(session('referral_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('referral_success') }}
                            @if(isset($referrerName))
                                <br><small>Referred by: <strong>{{ $referrerName }}</strong></small>
                            @endif
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('referral_error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('referral_error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(isset($referralCode) && $referralCode)
                        <div class="alert alert-info mb-3">
                            <i class="bi bi-gift me-2"></i><strong>Referral Code Active:</strong> {{ $referralCode }}
                            @if(isset($referrerName))
                                <br><small>Referred by: <strong>{{ $referrerName }}</strong></small>
                            @endif
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="bi bi-person me-2"></i>Full Name
                                </label>
                                <input id="name" type="text" 
                                       class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" 
                                       placeholder="Enter your full name" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-semibold">
                                    <i class="bi bi-telephone me-2"></i>Phone Number
                                </label>
                                <input id="phone" type="tel" 
                                       class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                       name="phone" value="{{ old('phone') }}" 
                                       placeholder="Enter your phone number">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope me-2"></i>Email Address (optional)
                            </label>
                            <input id="email" type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   placeholder="Enter your email address (optional)">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        @error('phone')
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                            </div>
                        @enderror

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-lock me-2"></i>Password
                                </label>
                                <input id="password" type="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       name="password" placeholder="Create a password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    <i class="bi bi-lock-fill me-2"></i>Confirm Password
                                </label>
                                <input id="password_confirmation" type="password" 
                                       class="form-control form-control-lg" 
                                       name="password_confirmation" placeholder="Confirm your password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg btn-custom">
                                <i class="bi bi-person-plus me-2"></i>Create Account
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-0">Already have an account? 
                            <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Sign In
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection