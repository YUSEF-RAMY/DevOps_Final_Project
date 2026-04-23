@extends('themes.theme1.layouts.app')

@section('title', $product->name)

@push('meta')
<!-- Primary Meta Tags -->
<meta name="title" content="{{ $product->meta_title ?? $product->name }}">
<meta name="description" content="{{ $product->meta_description ?? $product->short_description }}">
<meta name="keywords" content="{{ $product->name }}, {{ $product->category->name ?? '' }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="product">
<meta property="og:url" content="{{ route('products.show', $product->slug) }}">
<meta property="og:title" content="{{ $product->meta_title ?? $product->name }}">
<meta property="og:description" content="{{ $product->meta_description ?? $product->short_description }}">
@if($product->images->count() > 0)
<meta property="og:image" content="{{ asset($product->images->first()->path) }}">
@endif
<meta property="og:site_name" content="{{ $settings->site_name ?? 'eCommerce' }}">
<meta property="product:price:amount" content="{{ $product->price }}">
<meta property="product:price:currency" content="BDT">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ route('products.show', $product->slug) }}">
<meta property="twitter:title" content="{{ $product->meta_title ?? $product->name }}">
<meta property="twitter:description" content="{{ $product->meta_description ?? $product->short_description }}">
@if($product->images->count() > 0)
<meta property="twitter:image" content="{{ asset($product->images->first()->path) }}">
@endif
@endpush

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
<div class="container py-4">
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

    <!-- Page Builder Content -->
    @if($product->page_builder_data && is_array($product->page_builder_data) && count($product->page_builder_data) > 0)
        @foreach($product->page_builder_data as $block)
            @include('themes.theme1.products.page-builder._block', ['block' => $block, 'product' => $product])
        @endforeach
    @else
        <div class="alert alert-warning text-center py-5">
            <i class="bi bi-tools fs-1 d-block mb-3"></i>
            <h4>Custom Page Not Built Yet</h4>
            <p class="mb-4">This product's custom page hasn't been created yet. Please build it using the page builder in the admin panel.</p>
            <div class="d-flex gap-2 justify-content-center">
                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary">View Default Product Page</a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Browse All Products</a>
            </div>
            @if(auth('admin')->check())
                <hr class="my-4">
                <a href="{{ route('admin.products.page-builder', $product) }}" class="btn btn-success">
                    <i class="bi bi-pencil-square me-2"></i>Build This Page Now
                </a>
            @endif
        </div>
    @endif
</div>
@endsection

