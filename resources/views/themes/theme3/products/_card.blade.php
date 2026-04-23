<div class="card h-100 shadow-sm border-0 product-card">
    <div class="position-relative overflow-hidden">
        <a href="{{ route('products.show', $product->slug) }}">
            @if($product->images->count() > 0)
                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
            @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                    <i class="fas fa-image fa-3x text-muted"></i>
                </div>
            @endif
        </a>
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-75 opacity-0" style="transition: opacity 0.3s;">
            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm me-2">View Details</a>
            @if($product->stock > 0)
                <form action="{{ route('cart.add') }}" method="post" class="d-inline" onsubmit="return addToCartAjax(event, this)">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-light btn-sm">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </form>
            @endif
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title fw-semibold">
            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">{{ $product->name }}</a>
        </h5>
        <div class="mb-2">
            @php
                $rating = $product->reviews()->avg('rating') ?? 4;
                $fullStars = floor($rating);
                $hasHalfStar = ($rating - $fullStars) >= 0.5;
            @endphp
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $fullStars)
                    <i class="fas fa-star text-warning"></i>
                @elseif($i == $fullStars + 1 && $hasHalfStar)
                    <i class="fas fa-star-half-alt text-warning"></i>
                @else
                    <i class="far fa-star text-warning"></i>
                @endif
            @endfor
        </div>
        <p class="card-text fw-bold text-primary mb-0">@currency($product->price)</p>
    </div>
</div>

