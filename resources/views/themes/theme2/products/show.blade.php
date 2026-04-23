@extends('themes.theme2.layouts.app')

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

@push('styles')
<style>
/* Admin Edit Button */
.admin-edit-btn {
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.admin-edit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    background-color: var(--bs-primary);
    color: white !important;
    border-color: var(--bs-primary) !important;
}
.admin-edit-btn i {
    font-size: 1rem;
}

.rating-input {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    gap: 5px;
}
.rating-input input[type="radio"] {
    display: none;
}
.rating-input label {
    cursor: pointer;
    color: #ddd;
    font-size: 1.5rem;
    transition: color 0.2s;
}
/* Hover effect: highlight hovered label and all labels before it */
.rating-input label:hover,
.rating-input label:hover ~ label {
    color: #ffc107;
}
/* Active/checked state - handled by JavaScript */
.rating-input label.active {
    color: #ffc107;
}
.review-comment {
    line-height: 1.6;
}
.read-more-btn {
    font-size: 0.875rem;
    text-decoration: none;
    margin-left: 5px;
    vertical-align: baseline;
}
.read-more-btn:hover {
    text-decoration: underline;
}
.review-text-short,
.review-text-full {
    word-wrap: break-word;
}
.product-details {
    padding: 1.5rem;
}
@media (min-width: 992px) {
    .product-details {
        padding: 2rem;
    }
}
.product-details h1 {
    line-height: 1.2;
    color: #2c3e50;
}
.product-details .badge {
    padding: 0.5rem 0.75rem;
    font-weight: 500;
}
.product-details .border-bottom {
    border-color: #e9ecef !important;
}

/* Product Description HTML Styling */
.prose {
    line-height: 1.7;
    color: #333;
}
.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    margin-top: 1.5em;
    margin-bottom: 0.75em;
    font-weight: 600;
    line-height: 1.3;
}
.prose h1 { font-size: 2em; }
.prose h2 { font-size: 1.75em; }
.prose h3 { font-size: 1.5em; }
.prose h4 { font-size: 1.25em; }
.prose h5 { font-size: 1.1em; }
.prose h6 { font-size: 1em; }
.prose p {
    margin-bottom: 1em;
}
.prose ul, .prose ol {
    margin-bottom: 1em;
    padding-left: 2em;
}
.prose li {
    margin-bottom: 0.5em;
}
.prose a {
    color: #0d6efd;
    text-decoration: underline;
}
.prose a:hover {
    color: #0a58ca;
}
.prose strong {
    font-weight: 600;
}
.prose em {
    font-style: italic;
}
.prose blockquote {
    border-left: 4px solid #e9ecef;
    padding-left: 1em;
    margin: 1.5em 0;
    color: #6c757d;
    font-style: italic;
}
.prose img {
    max-width: 100%;
    height: auto;
    margin: 1em 0;
    border-radius: 0.375rem;
}
.prose code {
    background-color: #f8f9fa;
    padding: 0.2em 0.4em;
    border-radius: 0.25rem;
    font-size: 0.9em;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
}
.prose pre {
    background-color: #f8f9fa;
    padding: 1em;
    border-radius: 0.375rem;
    overflow-x: auto;
    margin: 1em 0;
}
.prose pre code {
    background-color: transparent;
    padding: 0;
}
.prose table {
    width: 100%;
    border-collapse: collapse;
    margin: 1em 0;
}
.prose table th,
.prose table td {
    border: 1px solid #dee2e6;
    padding: 0.5em;
    text-align: left;
}
.prose table th {
    background-color: #f8f9fa;
    font-weight: 600;
}
</style>
@endpush

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            @if($product->category)
                <li class="breadcrumb-item"><a href="{{ route('categories.show', $product->category->slug) }}">{{ $product->category->name }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    @if($product->images->count() > 0)
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($product->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                                             class="d-block w-100" 
                                             alt="{{ $product->name }}"
                                             style="height: 400px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            @if($product->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>
                        @if($product->images->count() > 1)
                            <div class="d-flex gap-2 flex-wrap mt-3" id="productThumbnails">
                                @foreach($product->images as $index => $image)
                                    <button type="button" class="btn p-0 border-0 thumb-btn {{ $index === 0 ? 'thumb-active' : '' }}" data-bs-target="#productCarousel" data-bs-slide-to="{{ $index }}" aria-label="Slide {{ $index + 1 }}">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }} thumbnail {{ $index + 1 }}" style="width: 80px; height: 60px; object-fit: cover;" class="rounded border">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height: 400px;">
                            <i class="bi bi-image text-muted display-1"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="product-details">
                <!-- Badges -->
                <div class="mb-3 d-flex flex-wrap gap-2 align-items-center">
                    @if($product->is_featured)
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-star-fill me-1"></i>Featured
                        </span>
                    @endif
                    @if($product->compare_at_price && $product->compare_at_price > $product->price)
                        @php
                            $discount = round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100);
                        @endphp
                        <span class="badge bg-danger">
                            <i class="bi bi-tag-fill me-1"></i>-{{ $discount }}% OFF
                        </span>
                    @endif
                    @if($product->stock > 0)
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle me-1"></i>In Stock
                        </span>
                    @else
                        <span class="badge bg-danger">
                            <i class="bi bi-x-circle me-1"></i>Out of Stock
                        </span>
                    @endif
                </div>

                <!-- Product Title -->
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h1 class="h2 fw-bold mb-0">{{ $product->name }}</h1>
                    @if(auth('admin')->check() && auth('admin')->user()->hasRole('Super Admin'))
                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                           class="btn btn-sm btn-outline-primary admin-edit-btn" 
                           title="Edit Product in Admin Panel"
                           style="border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; padding: 0;">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    @endif
                </div>
                
                <!-- SKU -->
                @if($product->sku)
                    <div class="mb-3">
                        <span class="text-muted small">
                            <i class="bi bi-upc me-1"></i>SKU: <strong class="text-dark">{{ $product->sku }}</strong>
                        </span>
                    </div>
                @endif

                <!-- Price Section -->
                <div class="mb-4 pb-3 border-bottom">
                    <div class="d-flex align-items-baseline gap-3 mb-2">
                        <span class="h3 text-primary fw-bold mb-0">@currency($product->price)</span>
                        @if($product->compare_at_price && $product->compare_at_price > $product->price)
                            <span class="text-muted text-decoration-line-through fs-5">
                                @currency($product->compare_at_price)
                            </span>
                        @endif
                    </div>
                    @if($product->stock > 0)
                        <p class="text-success mb-0 small">
                            <i class="bi bi-check-circle me-1"></i>{{ $product->stock }} available in stock
                        </p>
                    @endif
                </div>

                <!-- Quick Overview -->
                @if($product->short_description)
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-2 text-uppercase small">Quick Overview</h6>
                        <p class="text-muted mb-0">{{ $product->short_description }}</p>
                    </div>
                @endif

                        @php
                            $cartItem = null;
                            if (auth()->check()) {
                                $cart = \App\Models\Cart::where('user_id', auth()->id())->with('items')->first();
                                if ($cart) { $cartItem = $cart->items->firstWhere('product_id', $product->id); }
                            } else {
                                $sessionId = session('cart_session_id');
                                if ($sessionId) {
                                    $cart = \App\Models\Cart::where('session_id', $sessionId)->with('items')->first();
                                    if ($cart) { $cartItem = $cart->items->firstWhere('product_id', $product->id); }
                                }
                            }
                        @endphp

                <!-- Add to Cart Section -->
                <div class="mb-4">
                    @if($cartItem)
                        <div class="alert alert-success d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3" data-stock="{{ (int) $product->stock }}" data-item-id="{{ $cartItem->id }}">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle me-2"></i><strong>Carted</strong> ({{ $cartItem->quantity }} {{ Str::plural('item', $cartItem->quantity) }})
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <form action="{{ route('cart.items.update', $cartItem->id) }}" method="post" class="d-inline m-0" onsubmit="return pdUpdateCartItemAjax(event, this)">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ max(1, $cartItem->quantity - 1) }}">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary" style="width: 38px; height: 38px; padding: 0; display: flex; align-items: center; justify-content: center;" {{ $cartItem->quantity <= 1 ? 'disabled' : '' }}>
                                        <i class="bi bi-dash"></i>
                                    </button>
                                </form>
                                <form action="{{ route('cart.items.update', $cartItem->id) }}" method="post" class="d-inline m-0" onsubmit="return pdUpdateCartItemAjax(event, this)">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ min($product->stock, $cartItem->quantity + 1) }}">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary" style="width: 38px; height: 38px; padding: 0; display: flex; align-items: center; justify-content: center;" {{ $product->stock <= $cartItem->quantity ? 'disabled' : '' }}>
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn btn-sm btn-outline-danger" style="width: 38px; height: 38px; padding: 0; display: flex; align-items: center; justify-content: center;" title="Remove from cart" onclick="return pdRemoveCartItemAjax(event, {{ $cartItem->id }}, {{ (int) $product->id }}, {{ (int) $product->stock }});">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-primary w-100 mb-3">
                            <i class="bi bi-cart me-2"></i> View Cart
                        </a>
                    @else
                        <form action="{{ route('cart.add') }}" method="post" onsubmit="return pdAddToCartAjax(event, this)" data-stock="{{ (int) $product->stock }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-5">
                                    <label for="quantity" class="form-label fw-semibold small text-uppercase">Quantity</label>
                                    <input type="number" min="1" max="{{ $product->stock }}" 
                                           name="quantity" value="1" 
                                           class="form-control" 
                                           style="height: 48px;"
                                           id="quantity" required>
                                </div>
                                <div class="col-md-7">
                                    <label class="form-label fw-semibold small text-uppercase">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary w-100"
                                            style="height: 48px;"
                                            {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                        <i class="bi bi-cart-plus me-2"></i>
                                        {{ $product->stock <= 0 ? 'Out of Stock' : 'Add to Cart' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif

                    <!-- Wishlist Button -->
                    @php $settings = \App\Models\SiteSetting::get(); @endphp
                    @if($settings->wishlist_enabled ?? true)
                        <div class="mb-4">
                            @php
                                if (auth()->check()) {
                                    $isWishlisted = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
                                } else {
                                    $sid = session('wishlist_session_id');
                                    $isWishlisted = $sid ? \App\Models\GuestWishlist::where('session_id', $sid)->where('product_id', $product->id)->exists() : false;
                                }
                            @endphp
                            <button class="btn {{ $isWishlisted ? 'btn-danger' : 'btn-outline-danger' }} w-100 wishlist-toggle" data-product-id="{{ $product->id }}">
                                <i class="bi {{ $isWishlisted ? 'bi-heart-fill' : 'bi-heart' }} me-2"></i>
                                {{ $isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Product Features -->
                <div class="row g-3 mb-0">
                    <div class="col-4">
                        <div class="text-center p-3 bg-light rounded">
                            <i class="bi bi-truck text-primary fs-4 mb-2 d-block"></i>
                            <small class="text-muted d-block">Free Shipping</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center p-3 bg-light rounded">
                            <i class="bi bi-shield-check text-primary fs-4 mb-2 d-block"></i>
                            <small class="text-muted d-block">Secure Payment</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center p-3 bg-light rounded">
                            <i class="bi bi-arrow-clockwise text-primary fs-4 mb-2 d-block"></i>
                            <small class="text-muted d-block">Easy Returns</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Product Description -->
    @if($product->description)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="bi bi-info-circle me-2"></i>Product Description
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="prose">@mediaContent($product->description)</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Reviews Section -->
    @if($settings->reviews_enabled ?? true)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="bi bi-star me-2"></i>Reviews & Ratings
                            @if($product->total_reviews > 0)
                                <span class="badge bg-primary ms-2">{{ $product->total_reviews }} Review{{ $product->total_reviews > 1 ? 's' : '' }}</span>
                                <span class="ms-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= round($product->average_rating) ? '-fill text-warning' : '' }}"></i>
                                    @endfor
                                    <span class="ms-1">({{ number_format($product->average_rating, 1) }})</span>
                                </span>
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Review Form -->
                        @if(auth()->check() && !$userHasReviewed && ($userCanReview || !($settings->reviews_require_purchase ?? false)))
                            <div class="mb-4 p-3 bg-light rounded">
                                <h6 class="mb-3">Write a Review</h6>
                                <form id="review-form" action="{{ route('reviews.store', $product) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Rating</label>
                                        <div class="rating-input">
                                            @for($i = 1; $i <= 5; $i++)
                                                <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}" required>
                                                <label for="rating{{ $i }}" class="star-label"><i class="bi bi-star"></i></label>
                                            @endfor
                                        </div>
                                        <div id="rating-error" class="text-danger small" style="display:none;"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Review Title (Optional)</label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" maxlength="255">
                                        <div id="title-error" class="text-danger small" style="display:none;"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Your Review</label>
                                        <textarea name="comment" class="form-control" rows="4" required minlength="10" maxlength="1000">{{ old('comment') }}</textarea>
                                        <small class="text-muted">Minimum 10 characters</small>
                                        <div id="comment-error" class="text-danger small" style="display:none;"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="submit-review-btn">
                                        <span class="btn-text">Submit Review</span>
                                    </button>
                                </form>
                            </div>
                        @elseif(auth()->check() && $userHasReviewed)
                            <div class="alert alert-info mb-4">
                                <i class="bi bi-info-circle me-2"></i>You have already reviewed this product.
                            </div>
                        @elseif(!auth()->check() && !($settings->reviews_allow_anonymous ?? false))
                            <div class="alert alert-warning mb-4">
                                <i class="bi bi-exclamation-triangle me-2"></i>Please <a href="{{ route('login') }}">login</a> to write a review.
                            </div>
                        @endif

                        <!-- Reviews List -->
                        <div id="reviews-list-container">
                            @if($product->approvedReviews->count() > 0)
                                <div class="reviews-list">
                                    <h6 class="mb-3">Customer Reviews</h6>
                                    <div id="reviews-list">
                                        @foreach($product->approvedReviews->take(10) as $review)
                                            <div class="review-item border-bottom pb-3 mb-3">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <strong>{{ $review->user->name ?? 'Anonymous' }}</strong>
                                                        @if($review->is_verified_purchase)
                                                            <span class="badge bg-success ms-2"><i class="bi bi-check-circle me-1"></i>Verified Purchase</span>
                                                        @endif
                                                    </div>
                                                    <div class="text-muted small">@formatDate($review->created_at)</div>
                                                </div>
                                                <div class="mb-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill text-warning' : '' }}"></i>
                                                    @endfor
                                                </div>
                                                @if($review->title)
                                                    <h6 class="mb-2">{{ $review->title }}</h6>
                                                @endif
                                                @php
                                                    $comment = $review->comment;
                                                    $maxLength = 150;
                                                    $needsTruncation = strlen($comment) > $maxLength;
                                                    $shortText = $needsTruncation ? substr($comment, 0, $maxLength) . '...' : '';
                                                @endphp
                                                <div class="review-comment" data-full-text="{{ e($comment) }}">
                                                    @if($needsTruncation)
                                                        <span class="review-text-short">{{ $shortText }}</span>
                                                        <span class="review-text-full" style="display:none;">{{ $comment }}</span>
                                                        <button type="button" class="btn btn-link btn-sm p-0 text-primary read-more-btn">
                                                            <span class="read-more-text">Read More</span>
                                                            <span class="read-less-text" style="display:none;">Read Less</span>
                                                        </button>
                                                    @else
                                                        <span class="review-text-full">{{ $comment }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <p class="text-muted mb-0" id="no-reviews-msg">No reviews yet. Be the first to review this product!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Related Products -->
    @if($related->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="fw-bold mb-3">
                    <i class="bi bi-grid me-2"></i>Related Products
                </h3>
                <div class="position-relative">
                    <button type="button" class="btn btn-light border position-absolute top-50 start-0 translate-middle-y shadow-sm" id="relPrev" aria-label="Previous" style="z-index: 2;">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <style>
                        /* Hide scrollbar but keep scroll functionality */
                        #relatedScroller{ -ms-overflow-style: none; scrollbar-width: none; }
                        #relatedScroller::-webkit-scrollbar{ display: none; }
                        #relatedScroller.dragging{ cursor: grabbing; }
                    </style>
                    <div class="overflow-x-auto" id="relatedScroller">
                        <div class="d-flex flex-nowrap gap-3 m-0 p-1" style="scroll-behavior: smooth;">
                            @foreach($related as $relatedProduct)
                                <div class="flex-shrink-0" style="width: 280px;">
                                    @include('themes.theme2.products._card', ['product' => $relatedProduct])
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" class="btn btn-light border position-absolute top-50 end-0 translate-middle-y shadow-sm" id="relNext" aria-label="Next" style="z-index: 2;">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function(){
    // Thumbnails sync with carousel
    const carousel = document.getElementById('productCarousel');
    if (carousel) {
        carousel.addEventListener('slid.bs.carousel', function (e) {
            const idx = e.to;
            document.querySelectorAll('#productThumbnails .thumb-btn').forEach((btn, i) => {
                const img = btn.querySelector('img');
                if (i === idx) {
                    btn.classList.add('thumb-active');
                    img && img.classList.add('border-primary');
                } else {
                    btn.classList.remove('thumb-active');
                    img && img.classList.remove('border-primary');
                }
            });
        });
    }

    // Related slider controls
    const scrollerWrap = document.getElementById('relatedScroller');
    if (scrollerWrap) {
        const scroller = scrollerWrap.firstElementChild;
        const prev = document.getElementById('relPrev');
        const next = document.getElementById('relNext');
        const step = Math.min(360, Math.max(280, scrollerWrap.clientWidth * 0.6));
        const updateButtons = () => {
            if (!scroller) return;
            if (prev) {
                prev.disabled = scrollerWrap.scrollLeft <= 0;
                prev.classList.toggle('d-none', prev.disabled);
            }
            const maxScroll = scroller.scrollWidth - scrollerWrap.clientWidth - 1;
            next && (next.disabled = scrollerWrap.scrollLeft >= maxScroll);
        };
        prev && prev.addEventListener('click', (e) => { e.preventDefault(); scrollerWrap.scrollBy({ left: -step, behavior: 'smooth' }); });
        next && next.addEventListener('click', (e) => { e.preventDefault(); scrollerWrap.scrollBy({ left: step, behavior: 'smooth' }); });
        scrollerWrap.addEventListener('scroll', updateButtons, { passive: true });
        window.addEventListener('resize', updateButtons);
        setTimeout(updateButtons, 100);

        // Drag-to-scroll (mouse + touch)
        let isDown = false;
        let startX = 0;
        let startScrollLeft = 0;
        const startDrag = (clientX) => {
            isDown = true;
            startX = clientX;
            startScrollLeft = scrollerWrap.scrollLeft;
            scrollerWrap.classList.add('dragging');
        };
        const onMove = (clientX) => {
            if (!isDown) return;
            const dx = clientX - startX;
            scrollerWrap.scrollLeft = startScrollLeft - dx;
        };
        const endDrag = () => {
            isDown = false;
            scrollerWrap.classList.remove('dragging');
        };
        // Mouse
        scrollerWrap.addEventListener('mousedown', (e) => { e.preventDefault(); startDrag(e.clientX); });
        window.addEventListener('mousemove', (e) => onMove(e.clientX));
        window.addEventListener('mouseup', endDrag);
        // Touch
        scrollerWrap.addEventListener('touchstart', (e) => { if (e.touches[0]) startDrag(e.touches[0].clientX); }, { passive: true });
        scrollerWrap.addEventListener('touchmove', (e) => { if (e.touches[0]) onMove(e.touches[0].clientX); }, { passive: true });
        scrollerWrap.addEventListener('touchend', endDrag);
    }
});
function pdAddToCartAjax(e, form){
    e.preventDefault();
    
    // Prevent multiple simultaneous requests
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn && submitBtn.disabled) {
        return false;
    }
    
    // Disable button and show loading state
    if (submitBtn) {
        submitBtn.disabled = true;
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Adding...';
        
        // Re-enable button on error
        const reEnableButton = () => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        };
        
        const fd = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
            },
            body: fd
        }).then(r=>{
            if (!r.ok) {
                return r.json().then(err => {
                    throw new Error(err.message || 'Network response was not ok');
                }).catch(() => {
                    throw new Error('Network response was not ok');
                });
            }
            return r.json();
        }).then(data=>{
            if(!data || !data.success) {
                reEnableButton();
                // Show error message if available
                if(data && data.message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonColor: '#20c997'
                    });
                }
                return;
            }
            if(data.cart && typeof window.__updateCartCount === 'function'){
                window.__updateCartCount(data.cart.count);
            }
            const container = form.closest('.card');
            const wrap = document.createElement('div');
            wrap.className = 'alert alert-success d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3';
            wrap.setAttribute('data-stock', form.dataset.stock || '999999');
            wrap.setAttribute('data-item-id', data.item.id);
            wrap.innerHTML = `
                <div class="d-flex align-items-center"><i class="bi bi-check-circle me-2"></i><strong>Carted</strong> (${data.item.quantity} ${data.item.quantity>1?'items':'item'})</div>
                <div class="d-flex align-items-center gap-2">
                    <form action="${window.location.origin}/cart/items/${data.item.id}" method="post" class="d-inline m-0" onsubmit="return pdUpdateCartItemAjax(event, this)">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="quantity" value="${Math.max(1, data.item.quantity - 1)}">
                        <button type="submit" class="btn btn-sm btn-outline-secondary" style="width: 38px; height: 38px; padding: 0; display: flex; align-items: center; justify-content: center;" ${data.item.quantity<=1?'disabled':''}><i class="bi bi-dash"></i></button>
                    </form>
                    <form action="${window.location.origin}/cart/items/${data.item.id}" method="post" class="d-inline m-0" onsubmit="return pdUpdateCartItemAjax(event, this)">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="quantity" value="${data.item.quantity + 1}">
                        <button type="submit" class="btn btn-sm btn-outline-secondary" style="width: 38px; height: 38px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="bi bi-plus"></i></button>
                    </form>
                    <button type="button" class="btn btn-sm btn-outline-danger" style="width: 38px; height: 38px; padding: 0; display: flex; align-items: center; justify-content: center;" title="Remove from cart" onclick="return pdRemoveCartItemAjax(event, ${data.item.id}, ${form.querySelector('input[name=product_id]').value}, ${parseInt(form.dataset.stock || '0', 10)});">
                        <i class="bi bi-x"></i>
                    </button>
                </div>`;
            form.parentNode.replaceChild(wrap, form);
            // Insert View Cart button right after the alert (ensure only one)
            try {
                const cardBody = wrap.closest('.card-body') || wrap.parentNode;
                cardBody && cardBody.querySelectorAll('.js-view-cart-btn').forEach(n=>n.remove());
                const viewBtn = document.createElement('a');
                viewBtn.href = "{{ route('cart.index') }}";
                viewBtn.className = 'btn btn-outline-primary btn-custom mb-4 w-100 js-view-cart-btn';
                viewBtn.innerHTML = '<i class="bi bi-cart"></i> View Cart';
                wrap.insertAdjacentElement('afterend', viewBtn);
            } catch(_) {}
        }).catch((error)=>{
            console.error('Add to cart error:', error);
            reEnableButton();
            // Show user-friendly error message
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Failed to add item to cart. Please try again.',
                confirmButtonColor: '#20c997'
            });
        });
    } else {
        // Fallback if button not found
        const fd = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
            },
            body: fd
        }).then(r=>r.json()).then(data=>{
            if(!data || !data.success) return;
            if(data.cart && typeof window.__updateCartCount === 'function'){
                window.__updateCartCount(data.cart.count);
            }
            const container = form.closest('.card');
            const wrap = document.createElement('div');
            wrap.className = 'alert alert-success d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3';
            wrap.setAttribute('data-stock', form.dataset.stock || '999999');
            wrap.setAttribute('data-item-id', data.item.id);
            wrap.innerHTML = `
                <div class="d-flex align-items-center"><i class="bi bi-check-circle me-2"></i><strong>Carted</strong> (${data.item.quantity} ${data.item.quantity>1?'items':'item'})</div>
                <div class="d-flex align-items-center gap-2">
                    <form action="${window.location.origin}/cart/items/${data.item.id}" method="post" class="d-inline m-0" onsubmit="return pdUpdateCartItemAjax(event, this)">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="quantity" value="${Math.max(1, data.item.quantity - 1)}">
                        <button type="submit" class="btn btn-sm btn-outline-secondary" style="width: 38px; height: 38px; padding: 0; display: flex; align-items: center; justify-content: center;" ${data.item.quantity<=1?'disabled':''}><i class="bi bi-dash"></i></button>
                    </form>
                    <form action="${window.location.origin}/cart/items/${data.item.id}" method="post" class="d-inline m-0" onsubmit="return pdUpdateCartItemAjax(event, this)">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="quantity" value="${data.item.quantity + 1}">
                        <button type="submit" class="btn btn-sm btn-outline-secondary" style="width: 38px; height: 38px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="bi bi-plus"></i></button>
                    </form>
                    <button type="button" class="btn btn-sm btn-outline-danger" style="width: 38px; height: 38px; padding: 0; display: flex; align-items: center; justify-content: center;" title="Remove from cart" onclick="return pdRemoveCartItemAjax(event, ${data.item.id}, ${form.querySelector('input[name=product_id]').value}, ${parseInt(form.dataset.stock || '0', 10)});">
                        <i class="bi bi-x"></i>
                    </button>
                </div>`;
            form.parentNode.replaceChild(wrap, form);
            // Insert View Cart button right after the alert (ensure only one)
            try {
                const cardBody = wrap.closest('.card-body') || wrap.parentNode;
                cardBody && cardBody.querySelectorAll('.js-view-cart-btn').forEach(n=>n.remove());
                const viewBtn = document.createElement('a');
                viewBtn.href = "{{ route('cart.index') }}";
                viewBtn.className = 'btn btn-outline-primary btn-custom mb-4 w-100 js-view-cart-btn';
                viewBtn.innerHTML = '<i class="bi bi-cart"></i> View Cart';
                wrap.insertAdjacentElement('afterend', viewBtn);
            } catch(_) {}
        }).catch((error)=>{
            console.error('Add to cart error:', error);
        });
    }
    return false;
}

function pdUpdateCartItemAjax(e, form){
    e.preventDefault();
    const token = form.querySelector('input[name="_token"]').value;
    const qty = form.querySelector('input[name="quantity"]').value;
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: new URLSearchParams({ _method: 'PUT', quantity: qty })
    }).then(r=>r.json()).then(res=>{
        if(!res || !res.success) return false;
        if(typeof window.__updateCartCount === 'function'){
            window.__updateCartCount(res.cart.count);
        }
        const alertBox = form.closest('.alert');
        const stock = parseInt(alertBox.dataset.stock || '999999', 10);
        if(alertBox){
            alertBox.querySelector('div').innerHTML = `<i class=\"bi bi-check-circle me-2\"></i>Carted (${res.item.quantity} ${res.item.quantity>1?'items':'item'})`;
            const forms = alertBox.querySelectorAll('form');
            if(forms.length >= 2){
                const minusForm = forms[0];
                const plusForm = forms[1];
                const newQty = parseInt(res.item.quantity, 10);
                minusForm.querySelector('input[name=quantity]').value = Math.max(1, newQty - 1);
                plusForm.querySelector('input[name=quantity]').value = Math.min(stock, newQty + 1);
                minusForm.querySelector('button').disabled = newQty <= 1;
                plusForm.querySelector('button').disabled = newQty >= stock;
            }
        }
    }).catch(()=>{});
    return false;
}

function pdRemoveCartItemAjax(e, itemId, productId, stock){
    e.preventDefault();
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`${window.location.origin}/cart/items/${itemId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: new URLSearchParams({ _method: 'DELETE' })
    }).then(r=>r.json()).then(res=>{
        if(!res || !res.success) return false;
        if(typeof window.__updateCartCount === 'function'){
            window.__updateCartCount(res.cart.count);
        }
        // Swap alert with Add to Cart form and remove any adjacent View Cart button
        const alertBox = document.querySelector('.alert.alert-success[data-item-id]');
        if(alertBox){
            const cardBody = alertBox.closest('.card-body') || alertBox.parentNode;
            cardBody && cardBody.querySelectorAll('.js-view-cart-btn').forEach(n=>n.remove());
            const formHtml = `
            <form action="{{ route('cart.add') }}" method="post" class="mb-4" onsubmit="return pdAddToCartAjax(event, this)" data-stock="${stock}">
                <input type="hidden" name="_token" value="${token}">
                <input type="hidden" name="product_id" value="${productId}">
                <div class="row align-items-end">
                    <div class="col-md-4 mb-3">
                        <label for="quantity" class="form-label fw-semibold">Quantity</label>
                        <input type="number" min="1" max="${stock}" name="quantity" value="1" class="form-control form-control-lg" id="quantity" required>
                    </div>
                    <div class="col-md-8 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg w-100 btn-custom" ${stock <= 0 ? 'disabled' : ''}>
                            <i class="bi bi-cart-plus me-2"></i>
                            ${stock <= 0 ? 'Out of Stock' : 'Add to Cart'}
                        </button>
                    </div>
                </div>
            </form>`;
            const wrapper = document.createElement('div');
            wrapper.innerHTML = formHtml;
            alertBox.parentNode.replaceChild(wrapper.firstElementChild, alertBox);
        }
    }).catch(()=>{});
    return false;
}

// Read More/Less functionality for review comments
function initReadMore(container) {
    const reviewComments = container ? container.querySelectorAll('.review-comment') : document.querySelectorAll('.review-comment');
    
    reviewComments.forEach(commentDiv => {
        const shortText = commentDiv.querySelector('.review-text-short');
        const fullText = commentDiv.querySelector('.review-text-full');
        const readMoreBtn = commentDiv.querySelector('.read-more-btn');
        const readMoreText = readMoreBtn ? readMoreBtn.querySelector('.read-more-text') : null;
        const readLessText = readMoreBtn ? readMoreBtn.querySelector('.read-less-text') : null;
        
        // If no button, it means text is short and doesn't need truncation
        if (!readMoreBtn || !fullText) return;
        
        // If no short text element, text is already short, skip
        if (!shortText) return;
        
        // Set up click handler (only if button exists)
        readMoreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const isExpanded = fullText.style.display !== 'none';
            
            if (isExpanded) {
                // Collapse
                shortText.style.display = 'inline';
                fullText.style.display = 'none';
                if (readMoreText) readMoreText.style.display = 'inline';
                if (readLessText) readLessText.style.display = 'none';
            } else {
                // Expand
                shortText.style.display = 'none';
                fullText.style.display = 'inline';
                if (readMoreText) readMoreText.style.display = 'none';
                if (readLessText) readLessText.style.display = 'inline';
            }
        });
    });
}

// Review form AJAX submission
document.addEventListener('DOMContentLoaded', function(){
    // Initialize Read More for existing reviews
    initReadMore();
    
    const reviewForm = document.getElementById('review-form');
    if (!reviewForm) return;
    
    // Handle rating star display
    const ratingInputs = reviewForm.querySelectorAll('input[name="rating"]');
    const ratingLabels = reviewForm.querySelectorAll('.rating-input label');
    
    function updateStarDisplay(selectedValue) {
        ratingLabels.forEach((label, index) => {
            // Normal order: index 0 = star 1, index 1 = star 2, etc.
            const starNumber = index + 1;
            if (starNumber <= selectedValue) {
                label.classList.add('active');
                label.style.color = '#ffc107';
                // Change icon to filled star
                const icon = label.querySelector('i');
                if (icon) {
                    icon.classList.remove('bi-star');
                    icon.classList.add('bi-star-fill');
                }
            } else {
                label.classList.remove('active');
                label.style.color = '#ddd';
                // Change icon to empty star
                const icon = label.querySelector('i');
                if (icon) {
                    icon.classList.remove('bi-star-fill');
                    icon.classList.add('bi-star');
                }
            }
        });
    }
    
    // Update stars when a radio is selected
    ratingInputs.forEach(input => {
        input.addEventListener('change', function() {
            updateStarDisplay(parseInt(this.value));
        });
    });
    
    // Initialize display if a rating is already selected
    const checkedInput = reviewForm.querySelector('input[name="rating"]:checked');
    if (checkedInput) {
        updateStarDisplay(parseInt(checkedInput.value));
    }
    
    reviewForm.addEventListener('submit', function(e){
        e.preventDefault();
        
        const submitBtn = document.getElementById('submit-review-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const originalText = btnText.textContent;
        
        // Clear previous errors
        ['rating', 'title', 'comment'].forEach(field => {
            const errorEl = document.getElementById(field + '-error');
            if (errorEl) {
                errorEl.style.display = 'none';
                errorEl.textContent = '';
            }
        });
        
        // Disable button and show loading
        submitBtn.disabled = true;
        btnText.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Submitting...';
        
        const formData = new FormData(reviewForm);
        
        fetch(reviewForm.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': reviewForm.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    if (err.errors) {
                        Object.keys(err.errors).forEach(field => {
                            const errorEl = document.getElementById(field + '-error');
                            if (errorEl) {
                                errorEl.textContent = err.errors[field][0];
                                errorEl.style.display = 'block';
                            }
                        });
                    }
                    throw new Error(err.message || 'Request failed');
                });
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Failed to submit review');
            }
            
            // Show success message
            if (window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    confirmButtonColor: '#667eea',
                    timer: 3000,
                    timerProgressBar: true
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                    confirmButtonColor: '#20c997'
                });
            }
            
            // Update review stats in header
            if (data.stats) {
                const badge = document.querySelector('.card-header .badge');
                if (badge) {
                    badge.textContent = `${data.stats.total_reviews} Review${data.stats.total_reviews !== 1 ? 's' : ''}`;
                }
                
                const ratingSpan = document.querySelector('.card-header .ms-2');
                if (ratingSpan) {
                    let starsHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        const filled = i <= Math.round(data.stats.average_rating);
                        starsHtml += `<i class="bi bi-star${filled ? '-fill text-warning' : ''}"></i>`;
                    }
                    ratingSpan.innerHTML = starsHtml + `<span class="ms-1">(${data.stats.average_rating})</span>`;
                }
            }
            
            // If review is approved, add it to the list
            if (data.review && data.review.is_approved) {
                const container = document.getElementById('reviews-list-container');
                const noReviewsMsg = document.getElementById('no-reviews-msg');
                let reviewsList = document.getElementById('reviews-list');
                
                if (noReviewsMsg) {
                    noReviewsMsg.remove();
                }
                
                if (!reviewsList && container) {
                    container.innerHTML = `
                        <div class="reviews-list">
                            <h6 class="mb-3">Customer Reviews</h6>
                            <div id="reviews-list"></div>
                        </div>
                    `;
                    reviewsList = document.getElementById('reviews-list');
                }
                
                if (reviewsList) {
                    const reviewItem = document.createElement('div');
                    reviewItem.className = 'review-item border-bottom pb-3 mb-3';
                    
                    let starsHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        const filled = i <= data.review.rating;
                        starsHtml += `<i class="bi bi-star${filled ? '-fill text-warning' : ''}"></i>`;
                    }
                    
                    const verifiedBadge = data.review.is_verified_purchase 
                        ? '<span class="badge bg-success ms-2"><i class="bi bi-check-circle me-1"></i>Verified Purchase</span>'
                        : '';
                    
                    const titleHtml = data.review.title 
                        ? `<h6 class="mb-2">${data.review.title}</h6>`
                        : '';
                    
                    // Create review comment with Read More functionality
                    const commentText = data.review.comment || '';
                    const maxLength = 150;
                    let commentHtml = '';
                    
                    if (commentText.length > maxLength) {
                        const shortText = commentText.substring(0, maxLength) + '...';
                        commentHtml = `
                            <div class="review-comment" data-full-text="${commentText.replace(/"/g, '&quot;')}">
                                <span class="review-text-short">${shortText}</span>
                                <span class="review-text-full" style="display:none;">${commentText}</span>
                                <button type="button" class="btn btn-link btn-sm p-0 text-primary read-more-btn">
                                    <span class="read-more-text">Read More</span>
                                    <span class="read-less-text" style="display:none;">Read Less</span>
                                </button>
                            </div>
                        `;
                    } else {
                        commentHtml = `<div class="review-comment"><span class="review-text-full">${commentText}</span></div>`;
                    }
                    
                    reviewItem.innerHTML = `
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <strong>${data.review.user_name}</strong>
                                ${verifiedBadge}
                            </div>
                            <div class="text-muted small">${data.review.created_at}</div>
                        </div>
                        <div class="mb-2">${starsHtml}</div>
                        ${titleHtml}
                        ${commentHtml}
                    `;
                    
                    reviewsList.insertBefore(reviewItem, reviewsList.firstChild);
                    
                    // Initialize Read More for the new review
                    initReadMore(reviewItem);
                }
            }
            
            // Hide form
            const formContainer = reviewForm.closest('.mb-4');
            if (formContainer) {
                formContainer.innerHTML = `
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle me-2"></i>You have already reviewed this product.
                    </div>
                `;
            }
        })
        .catch(error => {
            // Re-enable button
            submitBtn.disabled = false;
            btnText.textContent = originalText;
            
            // Show error
            if (window.Swal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'An error occurred. Please try again.',
                    confirmButtonColor: '#667eea'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'An error occurred. Please try again.',
                    confirmButtonColor: '#20c997'
                });
            }
        });
    });
});
</script>

 


