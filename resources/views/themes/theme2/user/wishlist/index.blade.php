@extends('themes.theme2.layouts.app')

@section('title', 'My Wishlist')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0"><i class="bi bi-heart me-2"></i>My Wishlist</h1>
    </div>

    @if($items->isEmpty())
        <div class="text-center text-muted py-5">
            <i class="bi bi-heart fs-1 d-block mb-2"></i>
            <p>Your wishlist is empty.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Browse Products</a>
        </div>
    @else
        <div class="row g-3">
            @foreach($items as $wl)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    @include('themes.theme2.products._card', ['product' => $wl->product])
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection



