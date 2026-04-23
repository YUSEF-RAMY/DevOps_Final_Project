@extends('frontend.layouts.app')

@section('title', $page->meta_title ?? $page->title)

@if(!empty($page->meta_description))
@section('meta_description', $page->meta_description)
@endif
@if(!empty($page->meta_keywords))
@section('meta_keywords', $page->meta_keywords)
@endif

@php
    $pageIcons = [
        'help-center' => 'bi-question-circle',
        'shipping-info' => 'bi-truck',
        'returns' => 'bi-arrow-clockwise',
        'contact-us' => 'bi-telephone',
    ];
    $pageColors = [
        'help-center' => ['name' => 'primary', 'hex' => '#0d6efd', 'dark' => '#0a58ca'],
        'shipping-info' => ['name' => 'success', 'hex' => '#198754', 'dark' => '#146c43'],
        'returns' => ['name' => 'warning', 'hex' => '#ffc107', 'dark' => '#cc9a06'],
        'contact-us' => ['name' => 'info', 'hex' => '#0dcaf0', 'dark' => '#0aa2c0'],
    ];
    $icon = $pageIcons[$page->slug] ?? 'bi-file-text';
    $colorInfo = $pageColors[$page->slug] ?? $pageColors['help-center'];
    $color = $colorInfo['name'];
    $colorHex = $colorInfo['hex'];
    $colorDark = $colorInfo['dark'];
@endphp

@section('content')
<div class="page-wrapper">
    <!-- Hero Section -->
    <div class="page-hero bg-gradient-{{ $color }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center text-white py-5">
                    <div class="page-icon mb-3">
                        <i class="bi {{ $icon }} display-1"></i>
                    </div>
                    <h1 class="display-5 fw-bold mb-3">{{ $page->title }}</h1>
                    @if($page->meta_description)
                    <p class="lead mb-0">{{ $page->meta_description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none"><i class="bi bi-house me-1"></i>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                    </ol>
                </nav>

                <!-- Page Content -->
                <div class="page-content-card">
                    <div class="page-content-body">
                        @mediaContent($page->content)
                    </div>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-5">
                    <a href="{{ route('home') }}" class="btn btn-outline-{{ $color }} btn-lg">
                        <i class="bi bi-arrow-left me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.page-wrapper {
    min-height: 60vh;
}

.page-hero {
    position: relative;
    overflow: hidden;
}

.page-hero.bg-gradient-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
}

.page-hero.bg-gradient-success {
    background: linear-gradient(135deg, #198754 0%, #146c43 100%);
}

.page-hero.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107 0%, #cc9a06 100%);
}

.page-hero.bg-gradient-info {
    background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
}

.page-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.page-hero .container {
    position: relative;
    z-index: 1;
}

.page-icon {
    animation: fadeInDown 0.6s ease-out;
}

.page-icon i {
    filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
}

.page-content-card {
    background: #ffffff;
    border-radius: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    animation: fadeInUp 0.6s ease-out;
}

.page-content-body {
    padding: 3rem;
}

.page-content-body h2 {
    color: #1f2937;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-size: 1.75rem;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 0.5rem;
}

.page-content-body h2:first-child {
    margin-top: 0;
}

.page-content-body h3 {
    color: #374151;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    font-size: 1.5rem;
}

.page-content-body h4 {
    color: #4b5563;
    font-weight: 600;
    margin-top: 1.25rem;
    margin-bottom: 0.5rem;
    font-size: 1.25rem;
}

.page-content-body p {
    color: #6b7280;
    line-height: 1.8;
    margin-bottom: 1.25rem;
    font-size: 1.05rem;
}

.page-content-body ul,
.page-content-body ol {
    color: #6b7280;
    line-height: 1.8;
    margin-bottom: 1.25rem;
    padding-left: 2rem;
}

.page-content-body ul li,
.page-content-body ol li {
    margin-bottom: 0.75rem;
}

.page-content-body ul li::marker {
    color: {{ $colorHex }};
}

.page-content-body a {
    color: {{ $colorHex }};
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s;
}

.page-content-body a:hover {
    color: {{ $colorDark }};
    text-decoration: underline;
}

.page-content-body blockquote {
    border-left: 4px solid {{ $colorHex }};
    padding-left: 1.5rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6b7280;
}

.page-content-body table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
    overflow: hidden;
}

.page-content-body table th {
    background: {{ $colorHex }};
    color: white;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
}

.page-content-body table td {
    padding: 0.875rem 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.page-content-body table tr:last-child td {
    border-bottom: none;
}

.page-content-body table tr:nth-child(even) {
    background: #f9fafb;
}

.page-content-body img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 1.5rem 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.page-content-body code {
    background: #f3f4f6;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.9em;
    color: {{ $colorDark }};
}

.page-content-body pre {
    background: #1f2937;
    color: #f9fafb;
    padding: 1.5rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.page-content-body pre code {
    background: transparent;
    color: inherit;
    padding: 0;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .page-hero {
        padding: 2rem 0;
    }
    
    .page-hero .display-5 {
        font-size: 2rem;
    }
    
    .page-icon i {
        font-size: 3rem;
    }
    
    .page-content-body {
        padding: 1.5rem;
    }
    
    .page-content-body h2 {
        font-size: 1.5rem;
    }
    
    .page-content-body h3 {
        font-size: 1.25rem;
    }
}

/* Print Styles */
@media print {
    .page-hero {
        background: {{ $colorHex }} !important;
    }
    
    .page-content-card {
        box-shadow: none;
    }
}
</style>
@endpush
@endsection

