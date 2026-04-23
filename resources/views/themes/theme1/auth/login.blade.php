@extends('themes.theme1.layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle text-primary display-1"></i>
                        <h2 class="fw-bold mt-3">Welcome Back</h2>
                        <p class="text-muted">Sign in to your account to continue</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="login" class="form-label fw-semibold">
                                <i class="bi bi-person-badge me-2"></i>Email or Phone
                            </label>
                            <input id="login" type="text" 
                                   class="form-control form-control-lg @error('login') is-invalid @enderror" 
                                   name="login" value="{{ old('login') }}" 
                                   placeholder="Enter email address or phone number" required autofocus>
                            @error('login')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-lock me-2"></i>Password
                            </label>
                            <input id="password" type="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   name="password" placeholder="Enter your password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg btn-custom">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-0">Don't have an account? 
                            <a href="{{ route('register') }}" class="text-primary fw-semibold text-decoration-none">
                                <i class="bi bi-person-plus me-1"></i>Create Account
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection