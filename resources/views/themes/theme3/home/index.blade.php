@extends('themes.theme3.layouts.app')

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
<!-- Hero Section -->
<section class="bg-light py-5" style="background: linear-gradient(135deg, #fff 0%, #ffd6d6 100%);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4 text-dark">{{ $siteSettings->site_name ?? 'eCommerce Store' }}</h1>
                <p class="lead mb-4 text-muted">{{ $siteSettings->meta_description ?? 'Complete solution with reliable products, fast support, and simple returns. Explore curated items from our store.' }}</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">
                    Shop Now <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            <div class="col-lg-6">
                @if(!empty($siteSettings->hero_image_url))
                    <img src="{{ $siteSettings->hero_image_url }}" alt="Banner" class="img-fluid rounded shadow-lg">
                @else
                    <div class="bg-primary rounded shadow-lg d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="fas fa-store fa-5x text-white opacity-50"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Featured Categories -->
@if($categories->count() > 0)
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold position-relative d-inline-block w-100">
            Featured Categories
            <span class="position-absolute bottom-0 start-50 translate-middle-x bg-primary" style="width: 80px; height: 4px; border-radius: 2px;"></span>
        </h2>
        <div class="row g-4">
            @foreach($categories->take(3) as $category)
            <div class="col-md-4">
                <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden position-relative" style="height: 300px;">
                        @if($category->image_url)
                            <img src="{{ asset('storage/' . $category->image_url) }}" alt="{{ $category->name }}" class="card-img h-100" style="object-fit: cover; transition: transform 0.3s;">
                        @else
                            <div class="card-img h-100 bg-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-folder fa-5x text-white opacity-50"></i>
                            </div>
                        @endif
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0" style="transition: opacity 0.3s;">
                            <h5 class="text-white fw-bold mb-0">{{ $category->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Featured Products -->
@if($featuredProducts->count() > 0 || $latestProducts->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold position-relative d-inline-block w-100">
            All Products
            <span class="position-absolute bottom-0 start-50 translate-middle-x bg-primary" style="width: 80px; height: 4px; border-radius: 2px;"></span>
        </h2>
        <div class="row g-4">
            @foreach(($featuredProducts->count() > 0 ? $featuredProducts : $latestProducts)->take(8) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                @include('themes.theme3.products._card', ['product' => $product])
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-lg">View All Products</a>
        </div>
    </div>
</section>
@endif

<!-- Testimonials -->
<section class="py-5" id="about">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold position-relative d-inline-block w-100">
            What Our Customers Say
            <span class="position-absolute bottom-0 start-50 translate-middle-x bg-primary" style="width: 80px; height: 4px; border-radius: 2px;"></span>
        </h2>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-quote-left fa-3x text-primary mb-3"></i>
                        <p class="card-text lead">"We have been using this company's products for a long time. The quality, durability, and after-sales support are outstanding."</p>
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                        </div>
                        <h5 class="card-title mb-0">Happy Customer</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Product card hover effect
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            const overlay = this.querySelector('.position-absolute');
            if (overlay) overlay.style.opacity = '1';
        });
        card.addEventListener('mouseleave', function() {
            const overlay = this.querySelector('.position-absolute');
            if (overlay) overlay.style.opacity = '0';
        });
    });
</script>
@endpush

