@extends('themes.theme3.layouts.app')

@section('title', 'My Account')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-0 fw-bold">My Account</h2>
                <p class="mb-0">Manage your account settings and orders</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Account Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body text-center">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                            <i class="fas fa-user fa-3x text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                        <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="list-group shadow-sm">
                    <a href="#dashboard" class="list-group-item list-group-item-action active" data-tab="dashboard">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                    <a href="#orders" class="list-group-item list-group-item-action" data-tab="orders">
                        <i class="fas fa-shopping-bag me-2"></i>My Orders
                    </a>
                    <a href="#profile" class="list-group-item list-group-item-action" data-tab="profile">
                        <i class="fas fa-user me-2"></i>Profile
                    </a>
                </div>
            </div>
            <div class="col-lg-9">
                <div id="dashboard" class="tab-content">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0 fw-bold">Dashboard</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Welcome to your account dashboard.</p>
                        </div>
                    </div>
                </div>
                <div id="orders" class="tab-content d-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0 fw-bold">My Orders</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Your order history will appear here.</p>
                        </div>
                    </div>
                </div>
                <div id="profile" class="tab-content d-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0 fw-bold">Profile Information</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Name</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $('[data-tab]').on('click', function(e) {
        e.preventDefault();
        const tab = $(this).data('tab');
        $('[data-tab]').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').addClass('d-none');
        $('#' + tab).removeClass('d-none');
    });
</script>
@endpush

