@extends('themes.theme1.layouts.app')

@section('title', 'My Addresses')

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h2 mb-0"><i class="bi bi-geo-alt me-2 text-primary"></i>My Addresses</h1>
        <a href="{{ route('addresses.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Add New Address</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($addresses->count() === 0)
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
                <h3 class="h5 mb-2">No addresses yet</h3>
                <p class="text-muted mb-4">You haven't added any addresses. Add your first address to get started.</p>
                <a href="{{ route('addresses.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Add Your First Address</a>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($addresses as $address)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100 border-0 {{ $address->is_default ? 'border-primary border-2' : '' }}">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                            <h3 class="h6 mb-0 fw-semibold">
                                <i class="bi bi-{{ $address->type === 'billing' ? 'credit-card' : 'truck' }} me-2"></i>
                                {{ ucfirst($address->type) }} Address
                            </h3>
                            @if($address->is_default)
                                <span class="badge bg-primary">Default</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <p class="fw-semibold mb-2">{{ $address->full_name }}</p>
                            @if($address->company)
                                <p class="text-muted small mb-2"><i class="bi bi-building me-1"></i>{{ $address->company }}</p>
                            @endif
                            <p class="text-muted small mb-1">
                                <i class="bi bi-geo-alt me-1"></i>{{ $address->address_line_1 }}
                                @if($address->address_line_2)
                                    , {{ $address->address_line_2 }}
                                @endif
                            </p>
                            @if($address->upazila)
                                <p class="text-muted small mb-1"><i class="bi bi-geo me-1"></i>Upazila/Thana: {{ $address->upazila }}</p>
                            @endif
                            @if($address->district)
                                <p class="text-muted small mb-1"><i class="bi bi-geo me-1"></i>District: {{ $address->district }}</p>
                            @endif
                            @if($address->division)
                                <p class="text-muted small mb-1"><i class="bi bi-geo me-1"></i>Division: {{ $address->division }}</p>
                            @endif
                            @if($address->postal_code)
                                <p class="text-muted small mb-1"><i class="bi bi-mailbox me-1"></i>Postal Code: {{ $address->postal_code }}</p>
                            @endif
                            <p class="text-muted small mb-1"><i class="bi bi-globe me-1"></i>{{ $address->country }}</p>
                            @if($address->phone)
                                <p class="text-muted small mb-0"><i class="bi bi-telephone me-1"></i>{{ $address->phone }}</p>
                            @endif
                        </div>
                        <div class="card-footer bg-light d-flex gap-2 flex-wrap">
                            @if(!$address->is_default)
                                <form action="{{ route('addresses.set-default', $address) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-star me-1"></i>Set Default
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('addresses.edit', $address) }}" class="btn btn-sm btn-outline-success">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                            <form action="{{ route('addresses.destroy', $address) }}" method="POST" class="d-inline ms-auto" onsubmit="return confirm('Are you sure you want to delete this address?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
