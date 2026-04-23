@extends('themes.theme3.layouts.app')

@section('title', 'Login')

@section('content')
<!-- Login Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            @if(!empty($siteSettings->logo_url))
                                <img src="{{ $siteSettings->logo_url }}" alt="Logo" height="60" class="rounded mb-3">
                            @endif
                            <h2 class="fw-bold">Welcome Back</h2>
                            <p class="text-muted">Login to your account</p>
                        </div>
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                    <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required>
                                    <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="#" class="text-decoration-none text-primary">Forgot Password?</a>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                            
                            <div class="text-center">
                                <p class="mb-0 text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none text-primary fw-semibold">Sign Up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $('#togglePassword').on('click', function() {
        const $password = $('#password');
        const $icon = $('#eyeIcon');
        if ($password.attr('type') === 'password') {
            $password.attr('type', 'text');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            $password.attr('type', 'password');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
</script>
@endpush

