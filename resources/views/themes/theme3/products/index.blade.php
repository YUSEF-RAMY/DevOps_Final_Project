@extends('themes.theme3.layouts.app')

@section('title', 'Products')

@section('content')
<!-- Page Header -->
<section class="bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Products Section -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-0 fw-bold">All Products</h2>
            </div>
            <div class="col-md-6 text-md-end">
                <form method="GET" action="{{ route('products.index') }}" class="d-inline">
                    <select name="sort" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Default Sorting</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Sort by Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Sort by Price: High to Low</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    @include('themes.theme3.products._card', ['product' => $product])
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>No products found.
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
        <nav aria-label="Page navigation" class="mt-5">
            {{ $products->links() }}
        </nav>
        @endif
    </div>
</section>
@endsection

