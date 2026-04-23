@extends('themes.theme2.layouts.app')

@section('title', $category->name)

@push('schema')
@if(isset($collectionSchema) && !empty($collectionSchema))
<script type="application/ld+json">
{!! json_encode($collectionSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
@if(isset($breadcrumbs) && !empty($breadcrumbs))
<script type="application/ld+json">
{!! json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
@endpush

@section('content')
<div class="container py-5">
    @if($category->parent)
    <!-- Parent Category -->
    <section class="mb-5">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="h5 fw-semibold text-muted mb-3">
                    <i class="bi bi-arrow-up me-2"></i>Parent Category
                </h3>
            </div>
        </div>
        <div class="row g-3 g-md-4 justify-content-start">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('categories.show', $category->parent->slug) }}" class="cat-item d-block text-center text-decoration-none p-3 h-100 border rounded-3 bg-white">
                    @php $parentImg = $category->parent->image ? asset('storage/' . $category->parent->image) : asset('admin-assets/assets/img/AdminLTELogo.png'); @endphp
                    <div class="mx-auto mb-2 cat-avatar">
                        <img src="{{ $parentImg }}" alt="{{ $category->parent->name }}" class="rounded-circle" width="88" height="88" style="object-fit: cover;" />
                    </div>
                    <div class="small fw-semibold text-body text-truncate">{{ $category->parent->name }}</div>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold mb-1"><i class="bi bi-tags me-2 text-primary"></i>{{ $category->name }}</h1>
            @if(!empty($category->description))
                <p class="text-muted mb-0">{{ Str::limit($category->description, 160) }}</p>
            @endif
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary"><i class="bi bi-grid me-1"></i>All Products</a>
    </div>

    <!-- Grid -->
    @if($products->count() > 0)
        <div class="row g-4">
        	@foreach($products as $product)
            	<div class="col-lg-3 col-md-6">
                	@include('themes.theme2.products._card', ['product' => $product])
            	</div>
        	@endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    @else
        <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>No products found in this category.        </div>
    @endif
</div>

<style>
.cat-item{ transition: all .15s ease-in-out; }
.cat-item:hover{ transform: translateY(-2px); box-shadow: 0 .25rem .75rem rgba(0,0,0,.06); border-color: rgba(13,110,253,.35)!important; }
.cat-avatar{ width: 96px; height: 96px; border-radius: 50%; padding: 4px; background: linear-gradient(135deg, rgba(13,110,253,.25), rgba(13,110,253,.05)); display: flex; align-items: center; justify-content: center; }
@media (min-width: 992px){ .cat-item{ background-color:#fff; } }
</style>
@endsection


