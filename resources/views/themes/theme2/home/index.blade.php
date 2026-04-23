@extends('themes.theme2.layouts.app')

@section('title', 'Home')

@push('schema')
@if(isset($organizationSchema) && !empty($organizationSchema))
<script type="application/ld+json">
{!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
@if(isset($websiteSchema) && !empty($websiteSchema))
<script type="application/ld+json">
{!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
@endpush

@section('content')
<!-- Hero Section - Bootstrap Carousel Slider -->
<section class="hero-section mb-4">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="container py-5">
                    <div class="row align-items-center min-vh-50">
                        <div class="col-lg-6 text-white">
                            <span class="badge bg-light text-info px-3 py-2 mb-3 rounded-pill">
                                <i class="bi bi-lightning-charge me-1"></i>New Arrivals Daily
                            </span>
                            <h1 class="display-3 fw-bold mb-4 lh-sm">
                                Shop Smarter,<br>
                                <span class="text-warning">Live Better</span>
                            </h1>
                            <p class="fs-5 mb-4 text-white-75">
                                Transform your shopping experience with handpicked essentials. 
                                Fast delivery, best prices, and unmatched quality.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('products.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Shop Now
                                </a>
                                <a href="#featured" class="btn btn-outline-light btn-lg rounded-pill px-4 border-2">
                                    <i class="bi bi-star me-2"></i>Featured
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center mt-4 mt-lg-0">
                            <div class="bg-white bg-opacity-20 rounded-4 p-5 d-inline-block">
                                <i class="bi bi-bag-heart display-1 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="container py-5">
                    <div class="row align-items-center min-vh-50">
                        <div class="col-lg-6 text-white">
                            <span class="badge bg-warning text-dark px-3 py-2 mb-3 rounded-pill">
                                <i class="bi bi-percent me-1"></i>Special Offers
                            </span>
                            <h1 class="display-3 fw-bold mb-4 lh-sm">
                                Exclusive Deals<br>
                                <span class="text-warning">Up to 50% Off</span>
                            </h1>
                            <p class="fs-5 mb-4 text-white-75">
                                Don't miss out on our limited-time offers. Premium products at unbeatable prices. 
                                Shop now before they're gone!
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg rounded-pill px-5 shadow">
                                    <i class="bi bi-tag me-2"></i>View Deals
                                </a>
                                <a href="#featured" class="btn btn-outline-light btn-lg rounded-pill px-4 border-2">
                                    <i class="bi bi-gift me-2"></i>Best Sellers
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center mt-4 mt-lg-0">
                            <div class="bg-white bg-opacity-20 rounded-4 p-5 d-inline-block">
                                <i class="bi bi-tags display-1 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="container py-5">
                    <div class="row align-items-center min-vh-50">
                        <div class="col-lg-6 text-white">
                            <span class="badge bg-info text-white px-3 py-2 mb-3 rounded-pill">
                                <i class="bi bi-truck me-1"></i>Free Shipping
                            </span>
                            <h1 class="display-3 fw-bold mb-4 lh-sm">
                                Fast & Free<br>
                                <span class="text-warning">Delivery Worldwide</span>
                            </h1>
                            <p class="fs-5 mb-4 text-white-75">
                                Enjoy free shipping on orders over $50. Secure payment, easy returns, 
                                and 24/7 customer support. Your satisfaction is our priority.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('products.index') }}" class="btn btn-light btn-lg rounded-pill px-5 shadow">
                                    <i class="bi bi-cart-check me-2"></i>Start Shopping
                                </a>
                                <a href="#featured" class="btn btn-outline-light btn-lg rounded-pill px-4 border-2">
                                    <i class="bi bi-info-circle me-2"></i>Learn More
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center mt-4 mt-lg-0">
                            <div class="bg-white bg-opacity-20 rounded-4 p-5 d-inline-block">
                                <i class="bi bi-truck display-1 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <style>
        .hero-section {
            min-height: 500px;
        }
        .min-vh-50 {
            min-height: 500px;
        }
        .carousel-item {
            min-height: 500px;
        }
        .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            border: 2px solid transparent;
        }
        .carousel-indicators .active {
            background-color: #20c997;
            border-color: #20c997;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }
        .carousel-control-prev-icon:hover,
        .carousel-control-next-icon:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }
        @media (max-width: 768px) {
            .hero-section {
                min-height: 400px;
            }
            .min-vh-50 {
                min-height: 400px;
            }
            .carousel-item {
                min-height: 400px;
            }
            .display-3 {
                font-size: 2rem;
            }
        }
    </style>
</section>

<!-- Features Section - Grid Cards -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-6 fw-bold mb-2 text-info"><i class="bi bi-shield-check me-2"></i>Why Choose Us</h2>
                <p class="text-muted mb-0">Experience excellence in every interaction</p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @php
                $helpCenterPage = \App\Models\Page::where('slug', 'help-center')->where('is_active', true)->first();
                $shippingInfoPage = \App\Models\Page::where('slug', 'shipping-info')->where('is_active', true)->first();
                $returnsPage = \App\Models\Page::where('slug', 'returns')->where('is_active', true)->first();
                $contactUsPage = \App\Models\Page::where('slug', 'contact-us')->where('is_active', true)->first();
            @endphp
            
            @if($helpCenterPage)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('pages.show', $helpCenterPage->slug) }}" class="card h-100 text-decoration-none border border-info border-2 shadow-sm text-center p-4 customer-service-link rounded-4">
                    <div class="card-body">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                            <i class="bi bi-question-circle text-info fs-2"></i>
                        </div>
                        <h5 class="card-title text-dark fw-bold">Help Center</h5>
                        <p class="card-text text-muted small mb-0">Find answers to common questions</p>
                    </div>
                </a>
            </div>
            @endif
            
            @if($shippingInfoPage)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('pages.show', $shippingInfoPage->slug) }}" class="card h-100 text-decoration-none border border-info border-2 shadow-sm text-center p-4 customer-service-link rounded-4">
                    <div class="card-body">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                            <i class="bi bi-truck text-info fs-2"></i>
                        </div>
                        <h5 class="card-title text-dark fw-bold">Shipping Info</h5>
                        <p class="card-text text-muted small mb-0">Delivery options and rates</p>
                    </div>
                </a>
            </div>
            @endif
            
            @if($returnsPage)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('pages.show', $returnsPage->slug) }}" class="card h-100 text-decoration-none border border-info border-2 shadow-sm text-center p-4 customer-service-link rounded-4">
                    <div class="card-body">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                            <i class="bi bi-arrow-clockwise text-info fs-2"></i>
                        </div>
                        <h5 class="card-title text-dark fw-bold">Returns</h5>
                        <p class="card-text text-muted small mb-0">Return policy and process</p>
                    </div>
                </a>
            </div>
            @endif
            
            @if($contactUsPage)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('pages.show', $contactUsPage->slug) }}" class="card h-100 text-decoration-none border border-info border-2 shadow-sm text-center p-4 customer-service-link rounded-4">
                    <div class="card-body">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                            <i class="bi bi-telephone text-info fs-2"></i>
                        </div>
                        <h5 class="card-title text-dark fw-bold">Contact Us</h5>
                        <p class="card-text text-muted small mb-0">Get in touch with our team</p>
                    </div>
                </a>
            </div>
            @endif
        </div>
    </div>
    <style>
        .customer-service-link {
            transition: all 0.3s ease;
        }
        .customer-service-link:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 30px rgba(32, 201, 151, 0.25) !important;
            border-color: #20c997 !important;
        }
    </style>
</section>

<!-- Top Categories - Modern Grid -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-6 fw-bold mb-2 text-info"><i class="bi bi-grid-3x3-gap me-2"></i>Shop by Category</h2>
                <p class="text-muted mb-0">Explore our wide range of product categories</p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($categories as $cat)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('categories.show', $cat->slug) }}" class="cat-item d-block text-center text-decoration-none p-4 h-100 border border-info border-2 rounded-4 bg-white shadow-sm">
                        @php $img = $cat->image ? asset('storage/' . $cat->image) : asset('admin-assets/assets/img/AdminLTELogo.png'); @endphp
                        <div class="mx-auto mb-3 cat-avatar">
                            <img src="{{ $img }}" alt="{{ $cat->name }}" class="rounded-circle" width="80" height="80" style="object-fit: cover;" />
                        </div>
                        <div class="small fw-bold text-dark text-truncate">{{ $cat->name }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        .cat-item{ transition: all .3s ease; }
        .cat-item:hover{ 
            transform: translateY(-8px) scale(1.05); 
            box-shadow: 0 8px 20px rgba(32, 201, 151, 0.2) !important; 
            border-color: #20c997 !important; 
        }
        .cat-avatar{ 
            width: 88px; 
            height: 88px; 
            border-radius: 50%; 
            padding: 4px; 
            background: linear-gradient(135deg, rgba(32, 201, 151, 0.2), rgba(23, 162, 184, 0.1)); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
    </style>
</section>

<!-- Featured Products -->
<section id="featured" class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 fw-bold mb-3 text-info"><i class="bi bi-star-fill me-2"></i>Featured Products</h2>
                <p class="lead text-muted">Handpicked products just for you</p>
            </div>
        </div>
        @php
            $settings = \App\Models\SiteSetting::get();
            $mobileCols = (int) ($settings->product_display_columns_mobile ?? 2);
            $desktopCols = (int) ($settings->product_display_columns_desktop ?? 3);
            
            // Calculate Bootstrap column classes
            $mobileColClass = match($mobileCols) {
                1 => 'col-12',
                2 => 'col-6',
                3 => 'col-4',
                default => 'col-6',
            };
            
            $desktopColClass = match($desktopCols) {
                2 => 'col-lg-6',
                3 => 'col-lg-4',
                4 => 'col-lg-3',
                5 => 'col-lg-2',
                6 => 'col-lg-2',
                default => 'col-lg-4',
            };
            
            $colClass = $mobileColClass . ' ' . $desktopColClass;
        @endphp
        <div class="row g-4" style="--desktop-cols: {{ $desktopCols }};">
            @foreach($featuredProducts as $product)
                <div class="{{ $colClass }}">
                    @include('themes.theme2.products._card', ['product' => $product])
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('products.index') }}" class="btn btn-info btn-lg text-white rounded-pill px-5">
                <i class="bi bi-grid me-2"></i>View All Products
            </a>
        </div>
    </div>
</section>

<!-- Latest Products -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 fw-bold mb-3 text-info"><i class="bi bi-clock-history me-2"></i>Latest Products</h2>
                <p class="lead text-muted">Fresh arrivals in our store</p>
            </div>
        </div>
        @php
            $settings = \App\Models\SiteSetting::get();
            $mobileCols = (int) ($settings->product_display_columns_mobile ?? 2);
            $desktopCols = (int) ($settings->product_display_columns_desktop ?? 3);
            
            // Calculate Bootstrap column classes
            $mobileColClass = match($mobileCols) {
                1 => 'col-12',
                2 => 'col-6',
                3 => 'col-4',
                default => 'col-6',
            };
            
            $desktopColClass = match($desktopCols) {
                2 => 'col-lg-6',
                3 => 'col-lg-4',
                4 => 'col-lg-3',
                5 => 'col-lg-2',
                6 => 'col-lg-2',
                default => 'col-lg-4',
            };
            
            $colClass = $mobileColClass . ' ' . $desktopColClass;
        @endphp
        <div class="row g-4" style="--desktop-cols: {{ $desktopCols }};">
            @foreach($latestProducts as $product)
                <div class="{{ $colClass }}">
                    @include('themes.theme2.products._card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
/* Product Cards Responsive - Same as products/index */
.product-card {
    position: relative;
}
.product-image-wrapper {
    min-height: 180px;
    max-height: 280px;
}
.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.product-card .card-title a {
    font-size: clamp(0.875rem, 1.5vw, 1rem);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-word;
}
.product-card .badge {
    font-size: clamp(0.65rem, 1.2vw, 0.75rem);
    padding: 0.35rem 0.6rem;
    white-space: nowrap;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
}
.product-card .wishlist-toggle {
    width: clamp(32px, 4vw, 38px) !important;
    height: clamp(32px, 4vw, 38px) !important;
    font-size: clamp(0.9rem, 1.5vw, 1rem);
}
.product-card .h5 {
    font-size: clamp(1rem, 2vw, 1.25rem);
}
.product-card .card-text {
    font-size: clamp(0.75rem, 1.2vw, 0.875rem);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.product-card .btn {
    font-size: clamp(0.8rem, 1.3vw, 0.9rem);
    white-space: nowrap;
}
@media (max-width: 767.98px) {
    .product-image-wrapper {
        min-height: 160px;
        max-height: 220px;
    }
    .product-card .card-title a {
        font-size: 0.9rem;
    }
    .product-card .badge {
        font-size: 0.7rem;
        padding: 0.3rem 0.5rem;
    }
    .product-card .wishlist-toggle {
        width: 34px !important;
        height: 34px !important;
        font-size: 0.9rem;
    }
}
</style>

<!-- Newsletter Section -->
<section class="py-5 bg-info text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="fw-bold mb-2"><i class="bi bi-envelope-paper me-2"></i>Stay Updated</h3>
                <p class="mb-0 opacity-75">Subscribe to our newsletter and never miss out on great deals!</p>
            </div>
            <div class="col-lg-6">
                <form class="d-flex newsletter-subscribe-form" action="{{ route('newsletter.subscribe') }}" method="post">
                    @csrf
                    <input type="hidden" name="source" value="home">
                    <input type="email" name="email" class="form-control form-control-lg rounded-pill me-2" placeholder="Enter your email" required>
                    <button class="btn btn-light btn-lg rounded-pill px-4" type="submit">
                        <i class="bi bi-send me-1"></i>Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


