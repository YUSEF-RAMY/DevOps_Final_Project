@extends('frontend.layouts.app')

@section('title', 'Address Details')

@section('content')
<div class="container py-5">
    <div class="mx-auto" style="max-width: 900px;">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h2 mb-0"><i class="bi bi-geo-fill me-2 text-primary"></i>Address Details</h1>
            <a href="{{ route('addresses.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <p class="mb-2"><strong>Type:</strong> {{ ucfirst($address->type) }}</p>
                <p class="mb-2"><strong>Name:</strong> {{ $address->first_name }} {{ $address->last_name }}</p>
                <p class="mb-2"><strong>Address:</strong> {{ $address->address_line_1 }}{{ $address->address_line_2 ? ', ' . $address->address_line_2 : '' }}</p>
                <p class="mb-2"><strong>Phone:</strong> {{ $address->phone ?? '-' }}</p>
                <a href="{{ route('addresses.edit', $address) }}" class="btn btn-primary btn-sm">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
