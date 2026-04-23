@extends('themes.theme2.layouts.app')

@section('title', 'Products')

@push('styles')
<style>
/* Page Header */
.products-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 3.5rem 2.5rem;
    color: white;
    margin-bottom: 3rem;
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.25);
    position: relative;
    overflow: hidden;
}
.products-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    pointer-events: none;
}
.products-header::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
    pointer-events: none;
}
.products-header > * {
    position: relative;
    z-index: 1;
}
.products-header h1 {
    color: white;
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 2.5rem;
}
.products-header p {
    color: rgba(255, 255, 255, 0.95);
    margin-bottom: 0;
    font-size: 1.1rem;
}

/* Filter Sidebar - Desktop Only */
.filter-sidebar {
    position: sticky;
    top: 20px;
}
@media (max-width: 991.98px) {
    .filter-sidebar {
        display: none !important;
    }
}
.filter-sidebar .card {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(102, 126, 234, 0.1);
    background: white;
}
.filter-sidebar .card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.25rem 1.5rem;
    font-weight: 600;
    font-size: 1.1rem;
    border-bottom: none;
}
.filter-sidebar .card-header i {
    font-size: 1.2rem;
    margin-right: 0.5rem;
}
.filter-sidebar .card-body {
    padding: 1.5rem;
}
.filter-sidebar .list-group {
    border-radius: 10px;
    overflow: hidden;
}
.filter-sidebar .list-group-item {
    border: none;
    padding: 0.875rem 1.25rem;
    transition: all 0.3s ease;
    border-radius: 8px;
    margin-bottom: 0.25rem;
    cursor: pointer;
    font-weight: 500;
}
.filter-sidebar .list-group-item:hover {
    background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%);
    padding-left: 1.5rem;
    transform: translateX(5px);
    color: #667eea;
}
.filter-sidebar .list-group-item.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    transform: translateX(5px);
}
.filter-sidebar .form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}
.filter-sidebar .form-control,
.filter-sidebar .form-select {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
}
.filter-sidebar .form-control:focus,
.filter-sidebar .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
    transform: translateY(-2px);
}
.filter-sidebar .form-check {
    padding: 0.75rem;
    border-radius: 8px;
    transition: all 0.2s ease;
    margin-bottom: 0.5rem;
}
.filter-sidebar .form-check:hover {
    background: #f8f9fa;
}
.filter-sidebar .form-check-input {
    width: 1.25rem;
    height: 1.25rem;
    margin-top: 0.25rem;
    cursor: pointer;
}
.filter-sidebar .form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}
.filter-sidebar .form-check-label {
    cursor: pointer;
    font-weight: 500;
    margin-left: 0.5rem;
}
.filter-sidebar .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 10px;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}
.filter-sidebar .btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}
.filter-sidebar .btn-outline-secondary {
    border-radius: 10px;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
}
.filter-sidebar .btn-outline-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Product Cards */
.product-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef !important;
    border-radius: 12px;
    overflow: hidden;
    background: white;
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
}
.product-card .card-body {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    min-height: 200px;
}
.product-card .card-body > *:last-child {
    margin-top: auto;
}
/* Ensure cart section has consistent height */
.product-card .d-grid {
    min-height: 90px;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
.product-card .alert-success {
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 0 !important;
}
.product-card .alert-success > div:first-child {
    flex: 0 0 auto;
    min-width: 0;
}
.product-card .alert-success > div:last-child {
    flex: 0 0 auto;
}
/* Ensure Add to Cart button has same height as carted section */
.product-card form,
.product-card .btn-primary,
.product-card .btn-outline-primary {
    min-height: 38px;
}
.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    border-color: #667eea !important;
}
.product-image-wrapper {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
    min-height: 180px;
    max-height: 280px;
}
.product-image {
    transition: transform 0.4s ease;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.product-card:hover .product-image {
    transform: scale(1.08);
}
.product-card .card-title {
    margin-bottom: 0.5rem;
}
.product-card .card-title a {
    transition: color 0.2s ease;
    font-size: clamp(0.875rem, 1.5vw, 1rem);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-word;
}
.product-card .card-title a:hover {
    color: #667eea !important;
}
/* Badges - Responsive sizing */
.product-card .badge {
    font-size: clamp(0.65rem, 1.2vw, 0.75rem);
    padding: 0.35rem 0.6rem;
    white-space: nowrap;
    line-height: 1.2;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
}
.product-card .badge i {
    font-size: clamp(0.7rem, 1.2vw, 0.8rem);
}
/* Wishlist Button - Responsive sizing */
.product-card .wishlist-toggle {
    width: clamp(32px, 4vw, 38px) !important;
    height: clamp(32px, 4vw, 38px) !important;
    font-size: clamp(0.9rem, 1.5vw, 1rem);
    display: flex !important;
    align-items: center;
    justify-content: center;
    padding: 0 !important;
}
/* Price - Responsive sizing */
.product-card .h5 {
    font-size: clamp(1rem, 2vw, 1.25rem);
    line-height: 1.2;
}
.product-card .text-muted {
    font-size: clamp(0.75rem, 1.2vw, 0.875rem);
}
/* Short Description - Responsive */
.product-card .card-text {
    font-size: clamp(0.75rem, 1.2vw, 0.875rem);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
/* Buttons - Responsive sizing */
.product-card .btn {
    font-size: clamp(0.8rem, 1.3vw, 0.9rem);
    padding: 0.5rem 0.75rem;
    white-space: nowrap;
}
.product-card .btn-sm {
    font-size: clamp(0.7rem, 1.1vw, 0.8rem);
    padding: 0.25rem 0.5rem;
    min-width: 32px;
}
/* Alert (Carted state) - Responsive */
.product-card .alert {
    font-size: clamp(0.75rem, 1.2vw, 0.875rem);
    padding: 0.5rem 0.75rem;
}
/* Stock status - Responsive */
.product-card small {
    font-size: clamp(0.7rem, 1.1vw, 0.8rem);
}
/* Responsive adjustments for different column counts */
@media (min-width: 992px) {
    /* 4 columns - slightly smaller */
    #productGrid[style*="--desktop-cols: 4"] .product-image-wrapper {
        min-height: 160px;
        max-height: 220px;
    }
    #productGrid[style*="--desktop-cols: 4"] .product-card .card-title a {
        font-size: 0.875rem;
        -webkit-line-clamp: 2;
    }
    /* 5 columns - even smaller */
    #productGrid[style*="--desktop-cols: 5"] .product-image-wrapper {
        min-height: 140px;
        max-height: 200px;
    }
    #productGrid[style*="--desktop-cols: 5"] .product-card .card-title a {
        font-size: 0.8rem;
        -webkit-line-clamp: 2;
    }
    #productGrid[style*="--desktop-cols: 5"] .product-card .badge {
        font-size: 0.65rem;
        padding: 0.3rem 0.5rem;
    }
    #productGrid[style*="--desktop-cols: 5"] .product-card .wishlist-toggle {
        width: 32px !important;
        height: 32px !important;
        font-size: 0.85rem;
    }
    /* 6 columns - smallest */
    #productGrid[style*="--desktop-cols: 6"] .product-image-wrapper {
        min-height: 120px;
        max-height: 180px;
    }
    #productGrid[style*="--desktop-cols: 6"] .product-card .card-title a {
        font-size: 0.75rem;
        -webkit-line-clamp: 2;
    }
    #productGrid[style*="--desktop-cols: 6"] .product-card .badge {
        font-size: 0.6rem;
        padding: 0.25rem 0.4rem;
    }
    #productGrid[style*="--desktop-cols: 6"] .product-card .wishlist-toggle {
        width: 30px !important;
        height: 30px !important;
        font-size: 0.8rem;
    }
    #productGrid[style*="--desktop-cols: 6"] .product-card .h5 {
        font-size: 0.95rem;
    }
    #productGrid[style*="--desktop-cols: 6"] .product-card .btn {
        font-size: 0.75rem;
        padding: 0.4rem 0.6rem;
    }
}
/* Mobile adjustments */
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

/* Active Filters */
.active-filters-card {
    background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%);
    border-radius: 12px;
    border: 2px solid rgba(102, 126, 234, 0.1);
    box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
}
.active-filters-card .badge {
    padding: 0.6rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease;
}
.active-filters-card .badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Search Results Alert */
.alert-info {
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    box-shadow: 0 2px 10px rgba(13, 202, 240, 0.2);
    padding: 1.25rem 1.5rem;
    font-weight: 500;
}

/* Sort Dropdown */
.dropdown-toggle {
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}
.dropdown-toggle:hover {
    background: rgba(255, 255, 255, 1);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}
.dropdown-menu {
    border-radius: 12px;
    border: none;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    padding: 0.5rem;
    margin-top: 0.5rem;
}
.dropdown-item {
    border-radius: 8px;
    padding: 0.75rem 1rem;
    transition: all 0.2s ease;
    font-weight: 500;
}
.dropdown-item:hover {
    background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%);
    color: #667eea;
    transform: translateX(5px);
}
.dropdown-item.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

/* Pagination */
.pagination {
    justify-content: center;
}
.pagination .page-link {
    border-radius: 8px;
    margin: 0 2px;
    border: 1px solid #dee2e6;
    color: #667eea;
    transition: all 0.2s ease;
}
.pagination .page-link:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
    transform: translateY(-2px);
}
.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
}

/* Empty State */
.empty-state {
    padding: 4rem 2rem;
    text-align: center;
}
.empty-state i {
    opacity: 0.3;
}

/* Products Grid Spacing */
#productGrid {
    margin-top: 1rem;
}
/* Dynamic columns for 5 columns layout */
@media (min-width: 992px) {
    #productGrid[style*="--desktop-cols: 5"] > div {
        flex: 0 0 auto;
        width: calc(20% - 1rem);
        max-width: calc(20% - 1rem);
    }
}

/* Empty State Enhancement */
.empty-state {
    padding: 5rem 2rem;
    background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%);
    border-radius: 20px;
    border: 2px dashed rgba(102, 126, 234, 0.2);
}
.empty-state i {
    opacity: 0.2;
    font-size: 5rem;
}
.empty-state h3 {
    color: #495057;
    font-weight: 700;
}
.empty-state .btn {
    border-radius: 12px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    transition: all 0.3s ease;
}
.empty-state .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

/* Mobile Filter Offcanvas */
.offcanvas-start {
    border-right: 1px solid rgba(0, 0, 0, 0.1);
}
.offcanvas-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.25rem;
}
.offcanvas-header .btn-close {
    filter: invert(1);
    opacity: 0.9;
}
.offcanvas-body .list-group-item {
    border: none;
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
}
.offcanvas-body .list-group-item.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
}
.offcanvas-body .form-control-sm,
.offcanvas-body .form-select-sm {
    font-size: 0.875rem;
    padding: 0.5rem 0.75rem;
}
.offcanvas-body .btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

/* Responsive */
@media (max-width: 768px) {
    .products-header {
        padding: 2.5rem 1.5rem;
        text-align: center;
        border-radius: 15px;
    }
    .products-header h1 {
        font-size: 2rem;
    }
    .products-header p {
        font-size: 1rem;
    }
    #productGrid {
        margin-top: 0.5rem;
    }
    .product-card {
        margin-bottom: 1rem;
    }
}
@media (max-width: 991.98px) {
    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}
@media (min-width: 1200px) {
    .container-fluid {
        padding-left: 2rem;
        padding-right: 2rem;
    }
}
</style>
@endpush

@section('content')
<div class="container-fluid py-5 px-3 px-md-4 px-lg-5" style="max-width: 1400px;">
    @if(request('select') == '1')
    <style>
      header, nav.navbar, footer, .site-header, .site-footer { display:none !important; }
      body { padding-top: 0 !important; }
    </style>
    @endif
    <!-- Page Header -->
    @if(request('select') != '1')
    <div class="products-header">
        <div class="row align-items-center">
            <div class="col-lg-8 col-12 mb-3 mb-lg-0">
                <h1 class="display-5 fw-bold mb-2">
                    <i class="bi bi-grid-3x3-gap me-2"></i>Our Products
                </h1>
                <p class="lead mb-0">Discover our amazing collection of premium products</p>
            </div>
            <div class="col-lg-4 col-12">
                <div class="d-flex justify-content-lg-end justify-content-start">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown" style="border-radius: 8px;">
                            <i class="bi bi-sort-down me-2"></i>Sort Products
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow" style="border-radius: 8px; border: none;">
                            <li><a class="dropdown-item {{ request('sort') == 'newest' || !request()->has('sort') ? 'active' : '' }}" 
                                   href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">
                                   <i class="bi bi-clock-history me-2"></i>Newest First</a></li>
                            <li><a class="dropdown-item {{ request('sort') == 'oldest' ? 'active' : '' }}" 
                                   href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">
                                   <i class="bi bi-clock me-2"></i>Oldest First</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item {{ request('sort') == 'name' ? 'active' : '' }}" 
                                   href="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}">
                                   <i class="bi bi-sort-alpha-down me-2"></i>Name A-Z</a></li>
                            <li><a class="dropdown-item {{ request('sort') == 'name_desc' ? 'active' : '' }}" 
                                   href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}">
                                   <i class="bi bi-sort-alpha-down-alt me-2"></i>Name Z-A</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item {{ request('sort') == 'price_asc' ? 'active' : '' }}" 
                                   href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}">
                                   <i class="bi bi-sort-numeric-down me-2"></i>Price Low to High</a></li>
                            <li><a class="dropdown-item {{ request('sort') == 'price_desc' ? 'active' : '' }}" 
                                   href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}">
                                   <i class="bi bi-sort-numeric-down-alt me-2"></i>Price High to Low</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(request('select') == '1')
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div>
            <i class="bi bi-hand-index-thumb me-2"></i>
            Select products to add to the POS. Use filters and pagination freely. Click "Done" when finished.
        </div>
        <div>
            <button class="btn btn-sm btn-outline-secondary" id="posSelectDoneBtn"><i class="bi bi-check2"></i> Done</button>
        </div>
    </div>
    @endif

    <div class="row">
        <!-- Mobile Filter Toggle Button -->
        <div class="col-12 d-lg-none mb-3">
            <button class="btn btn-primary w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas" style="border-radius: 12px; padding: 0.75rem; font-weight: 600;">
                <i class="bi bi-funnel-fill me-2"></i>Filter Products
            </button>
        </div>

        <!-- Desktop Sidebar Filters -->
        <aside class="col-lg-3 mb-4 filter-sidebar d-none d-lg-block">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0">
                    <h5 class="mb-0"><i class="bi bi-funnel-fill me-2"></i>Filter Products</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('products.index') }}" class="d-grid gap-3">
                        @if(request('select') == '1')
                        <input type="hidden" name="select" value="1">
                        @endif
                        <div>
                            <label class="form-label fw-semibold">Search</label>
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search products..." />
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Category</label>
                            <div class="list-group list-group-flush">
                                <a class="list-group-item list-group-item-action {{ request('category') ? '' : 'active' }}" href="{{ route('products.index', array_merge(request()->except('category'), ['category' => null])) }}">All</a>
                                @foreach($categories as $cat)
                                    <a class="list-group-item list-group-item-action {{ request('category') === $cat->slug ? 'active' : '' }}" href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $cat->slug])) }}">{{ $cat->name }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Price</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" step="0.01" min="0" name="min_price" value="{{ request('min_price') }}" class="form-control" placeholder="Min" />
                                </div>
                                <div class="col-6">
                                    <input type="number" step="0.01" min="0" name="max_price" value="{{ request('max_price') }}" class="form-control" placeholder="Max" />
                                </div>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="featuredCheck" name="featured" {{ request('featured') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="featuredCheck">Featured only</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="stockCheck" name="in_stock" {{ request('in_stock') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="stockCheck">In stock only</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="saleCheck" name="on_sale" {{ request('on_sale') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="saleCheck">On sale</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="imageCheck" name="has_image" {{ request('has_image') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="imageCheck">With images</label>
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Sort by</label>
                            <select class="form-select" name="sort">
                                <option value="newest" {{ request('sort') == 'newest' || !request()->has('sort') ? 'selected' : '' }}>Newest first</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest first</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price low to high</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price high to low</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <div class="input-group">
                                <label class="input-group-text" for="perPage">Per page</label>
                                <select name="per_page" id="perPage" class="form-select">
                                    @foreach([12, 24, 36, 48] as $pp)
                                        <option value="{{ $pp }}" {{ (int)request('per_page', 12) === $pp ? 'selected' : '' }}>{{ $pp }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-funnel me-1"></i>Apply filters</button>
                            <a href="{{ request('select') == '1' ? route('products.index', ['select' => 1]) : route('products.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x-circle me-1"></i>Clear all</a>
                        </div>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile Filter Offcanvas -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel" style="width: 320px;">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title fw-bold" id="filterOffcanvasLabel">
                    <i class="bi bi-funnel-fill me-2 text-primary"></i>Filter Products
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <div class="card border-0 shadow-none">
                    <div class="card-body p-3">
                        <form method="GET" action="{{ route('products.index') }}" class="d-grid gap-3" id="mobileFilterForm">
                            @if(request('select') == '1')
                            <input type="hidden" name="select" value="1">
                            @endif
                            <div>
                                <label class="form-label fw-semibold small">Search</label>
                                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Search products..." />
                            </div>

                            <div>
                                <label class="form-label fw-semibold small">Category</label>
                                <div class="list-group list-group-flush">
                                    <a class="list-group-item list-group-item-action py-2 {{ request('category') ? '' : 'active' }}" href="{{ route('products.index', array_merge(request()->except('category'), ['category' => null])) }}">All</a>
                                    @foreach($categories as $cat)
                                        <a class="list-group-item list-group-item-action py-2 {{ request('category') === $cat->slug ? 'active' : '' }}" href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $cat->slug])) }}">{{ $cat->name }}</a>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label class="form-label fw-semibold small">Price</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" step="0.01" min="0" name="min_price" value="{{ request('min_price') }}" class="form-control form-control-sm" placeholder="Min" />
                                    </div>
                                    <div class="col-6">
                                        <input type="number" step="0.01" min="0" name="max_price" value="{{ request('max_price') }}" class="form-control form-control-sm" placeholder="Max" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="mobileFeaturedCheck" name="featured" {{ request('featured') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="mobileFeaturedCheck">Featured only</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="mobileStockCheck" name="in_stock" {{ request('in_stock') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="mobileStockCheck">In stock only</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="mobileSaleCheck" name="on_sale" {{ request('on_sale') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="mobileSaleCheck">On sale</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="mobileImageCheck" name="has_image" {{ request('has_image') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="mobileImageCheck">With images</label>
                            </div>

                            <div>
                                <label class="form-label fw-semibold small">Sort by</label>
                                <select class="form-select form-select-sm" name="sort">
                                    <option value="newest" {{ request('sort') == 'newest' || !request()->has('sort') ? 'selected' : '' }}>Newest first</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest first</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price low to high</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price high to low</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2">
                                <div class="input-group input-group-sm">
                                    <label class="input-group-text" for="mobilePerPage">Per page</label>
                                    <select name="per_page" id="mobilePerPage" class="form-select">
                                        @foreach([12, 24, 36, 48] as $pp)
                                            <option value="{{ $pp }}" {{ (int)request('per_page', 12) === $pp ? 'selected' : '' }}>{{ $pp }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bi bi-funnel me-1"></i>Apply filters
                                </button>
                                <a href="{{ request('select') == '1' ? route('products.index', ['select' => 1]) : route('products.index') }}" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="offcanvas">
                                    <i class="bi bi-x-circle me-1"></i>Clear all
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-12 col-lg-9">
            <!-- Active Filters -->
            @if(request()->hasAny(['featured', 'in_stock', 'sort', 'q', 'category', 'min_price', 'max_price']))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 active-filters-card shadow-sm">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center flex-wrap gap-2">
                                    <span class="text-muted me-2 fw-semibold">
                                        <i class="bi bi-funnel-fill me-1"></i>Active filters:
                                    </span>
                                    @if(request('q'))
                                        <span class="badge bg-primary">
                                            <i class="bi bi-search me-1"></i>Search: "{{ request('q') }}"
                                        </span>
                                    @endif
                                    @if(request('category'))
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-tag me-1"></i>Category: {{ request('category') }}
                                        </span>
                                    @endif
                                    @if(request('min_price') || request('max_price'))
                                        <span class="badge bg-info">
                                            <i class="bi bi-currency-dollar me-1"></i>Price: {{ request('min_price') ?: '0' }} - {{ request('max_price') ?: '∞' }}
                                        </span>
                                    @endif
                                    @if(request('featured') == '1')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-star-fill me-1"></i>Featured
                                        </span>
                                    @endif
                                    @if(request('in_stock') == '1')
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>In stock
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Search Results Info -->
            @if(request('q'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-info shadow-sm">
                            <i class="bi bi-search me-2"></i>
                            Showing <strong>{{ $products->total() }}</strong> {{ Str::plural('result', $products->total()) }} for "<strong>{{ request('q') }}</strong>"
                        </div>
                    </div>
                </div>
            @endif

            <!-- Products Grid -->
            @if($products->count() > 0)
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
                        5 => 'col-lg-2', // 5 columns is tricky, using col-lg-2 with custom CSS
                        6 => 'col-lg-2',
                        default => 'col-lg-4',
                    };
                    
                    $colClass = $mobileColClass . ' ' . $desktopColClass;
                @endphp
                <div id="productGrid" class="row g-4 g-md-5" style="--desktop-cols: {{ $desktopCols }};">
                    @foreach($products as $product)
                        <div class="{{ $colClass }}">
                            @include('themes.theme2.products._card', ['product' => $product])
                        </div>
                    @endforeach
                </div>

                <!-- Infinite Scroll Sentinel -->
                <div id="infinite-scroll-sentinel" class="text-center text-muted py-4"></div>
                <div id="pagination-data" data-next-url="{{ $products->nextPageUrl() ?? '' }}" hidden></div>

                <!-- Visible Pagination Numbers -->
                <div class="row mt-4">
                    <div class="col-12">
                        <nav id="pagination-container" aria-label="Products pagination">
                            {{ $products->links() }}
                        </nav>
                    </div>
                </div>
            @else
                <!-- No Products Found -->
                <div class="row">
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-inbox display-1 text-muted mb-4"></i>
                            <h3 class="fw-bold mb-3">No Products Found</h3>
                            <p class="text-muted mb-4 lead">
                                @if(request('q'))
                                    We couldn't find any products matching "<strong>{{ request('q') }}</strong>".<br>
                                    Try searching with different keywords or browse our categories.
                                @else
                                    There are no products available at the moment.<br>
                                    Please check back later or contact us for more information.
                                @endif
                            </p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg" style="border-radius: 8px;">
                                <i class="bi bi-arrow-left me-2"></i>Back to All Products
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const grid = document.getElementById('productGrid');
    const sentinel = document.getElementById('infinite-scroll-sentinel');
    const dataEl = document.getElementById('pagination-data');
    if(!grid || !sentinel || !dataEl) return;

    let nextUrl = dataEl.dataset.nextUrl;
    let loading = false;

    const loadMore = async () => {
        if (!nextUrl || loading) return;
        loading = true;
        sentinel.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
        try {
            const res = await fetch(nextUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' } });
            const html = await res.text();
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const newGrid = doc.getElementById('productGrid');
            const newCards = newGrid ? Array.from(newGrid.children) : [];
            newCards.forEach(node => grid.appendChild(node));
            const newDataEl = doc.getElementById('pagination-data');
            nextUrl = newDataEl ? newDataEl.dataset.nextUrl : '';

            // Update pagination numbers to reflect current page
            const newPagination = doc.getElementById('pagination-container');
            const paginationContainer = document.getElementById('pagination-container');
            if (newPagination && paginationContainer) {
                paginationContainer.innerHTML = newPagination.innerHTML;
            }
            if (!nextUrl) {
                sentinel.innerHTML = '<span>No more products</span>';
                observer.disconnect();
            } else {
                sentinel.innerHTML = '';
            }
        } catch(e){
            sentinel.innerHTML = '';
        } finally {
            loading = false;
        }
    };

    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            loadMore();
        }
    }, { rootMargin: '400px 0px 0px 0px' });

    observer.observe(sentinel);
});
</script>
@if(request('select') == '1')
<script>
document.addEventListener('click', function(e){
  const btn = e.target.closest('[data-select-product-id]');
  if(!btn) return;
  e.preventDefault();
  const pid = btn.getAttribute('data-select-product-id');
  const name = btn.getAttribute('data-product-name') || '';
  const sku = btn.getAttribute('data-product-sku') || '';
  const price = parseFloat(btn.getAttribute('data-product-price')||'0');
  let qty = 1;
  const card = btn.closest('.card');
  if(card){
    const qEl = card.querySelector('[data-select-qty]');
    if(qEl){ qty = Math.max(1, parseInt(qEl.value||'1',10)); }
  }
  try {
    if(window.opener){
      window.opener.postMessage({ type: 'POS_SELECT_PRODUCT', product_id: pid, name, sku, price, quantity: qty }, '*');
    }
    // Visual feedback
    btn.classList.remove('btn-outline-primary');
    btn.classList.add('btn-success');
    btn.innerHTML = '<i class="bi bi-check2"></i> Added';
    setTimeout(()=>{
      btn.classList.remove('btn-success');
      btn.classList.add('btn-outline-primary');
      btn.innerHTML = '<i class="bi bi-check2-circle me-1"></i> Select This Product';
    }, 800);
  } catch(_) {}
});
document.getElementById('posSelectDoneBtn')?.addEventListener('click', function(){ try{ window.close(); }catch(_){} });
</script>
@endif
@endpush

