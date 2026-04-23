@extends('themes.theme3.layouts.app')

@section('title', $product->name)

@push('schema')
@if(isset($productSchema) && !empty($productSchema))
<script type="application/ld+json">
{!! json_encode($productSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
@if(isset($breadcrumbs) && !empty($breadcrumbs))
<script type="application/ld+json">
{!! json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
@endpush

@section('content')
<!-- Page Header -->
<section class="bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Product Details Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="mb-4">
                    @if($product->images->count() > 0)
                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" id="productImg" class="img-fluid rounded shadow" alt="{{ $product->name }}" style="max-height: 500px; width: 100%; object-fit: contain;">
                    @else
                        <div class="bg-light rounded shadow d-flex align-items-center justify-content-center" style="height: 500px;">
                            <i class="fas fa-image fa-5x text-muted"></i>
                        </div>
                    @endif
                </div>
                @if($product->images->count() > 1)
                <div class="row g-2">
                    @foreach($product->images->take(4) as $image)
                    <div class="col-3">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded small-img border border-2" alt="Thumbnail" style="height: 100px; object-fit: cover; cursor: pointer;" onclick="document.getElementById('productImg').src = this.src">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>
                <div class="mb-3">
                    @php
                        $rating = $product->approvedReviews->avg('rating') ?? 4;
                        $fullStars = floor($rating);
                    @endphp
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $fullStars)
                            <i class="fas fa-star text-warning"></i>
                        @else
                            <i class="far fa-star text-warning"></i>
                        @endif
                    @endfor
                    <span class="ms-2 text-muted">({{ number_format($rating, 1) }})</span>
                </div>
                <h3 class="text-primary mb-4">@currency($product->price)</h3>
                
                <form action="{{ route('cart.add') }}" method="post" class="mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-4">
                        <label for="quantity" class="form-label fw-bold">Quantity:</label>
                        <div class="input-group" style="width: 150px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('quantity').stepDown()">-</button>
                            <input type="number" class="form-control text-center" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                            <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('quantity').stepUp()">+</button>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart me-2"></i>{{ $product->stock <= 0 ? 'Out of Stock' : 'Add To Cart' }}
                        </button>
                        @if($settings->wishlist_enabled ?? true)
                        <button type="button" class="btn btn-outline-primary btn-lg wishlist-toggle" data-product-id="{{ $product->id }}">
                            <i class="fas fa-heart me-2"></i>Wishlist
                        </button>
                        @endif
                    </div>
                </form>

                @if($product->description)
                <div>
                    <h4 class="mb-3">Product Details</h4>
                    <div class="prose">
                        @mediaContent($product->description)
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
@if($related->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold">Related Products</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">View More</a>
        </div>
        <div class="row g-4">
            @foreach($related->take(4) as $relatedProduct)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    @include('themes.theme3.products._card', ['product' => $relatedProduct])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

