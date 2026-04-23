<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $siteSettings->meta_title ?? ($siteSettings->site_name ?? 'eCommerce Store'))</title>
    @if(!empty($siteSettings->meta_description))
    <meta name="description" content="{{ $siteSettings->meta_description }}">
    @endif
    @if(!empty($siteSettings->meta_keywords))
    <meta name="keywords" content="{{ $siteSettings->meta_keywords }}">
    @endif
    @if(!empty($siteSettings->logo_url))
    <meta property="og:image" content="{{ $siteSettings->logo_url }}">
    @endif
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @if(!empty($siteSettings->favicon_url))
    <link rel="icon" href="{{ $siteSettings->favicon_url }}" />
    @endif
    
    @stack('schema')
    
    <!-- Tracking Codes - Head Section -->
    @if(!empty($siteSettings->google_analytics_code))
        {!! $siteSettings->google_analytics_code !!}
    @endif
    @if(!empty($siteSettings->facebook_pixel_code))
        {!! $siteSettings->facebook_pixel_code !!}
    @endif
    @if(!empty($siteSettings->microsoft_clarity_code))
        {!! $siteSettings->microsoft_clarity_code !!}
    @endif
    @if(!empty($siteSettings->custom_head_code))
        {!! $siteSettings->custom_head_code !!}
    @endif
    
    <!-- Custom CSS -->
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
        }
        a {
            text-decoration: none !important;
        }
        .product-card:hover .position-absolute {
            opacity: 1 !important;
        }
        .product-card .position-absolute {
            transition: opacity 0.3s;
        }
        @media (max-width: 767.98px) {
            body {
                padding-bottom: 60px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('themes.theme3.partials.nav')
    
    <main>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>
    
    @include('themes.theme3.partials.footer')
    
    @include('themes.theme3.partials.mobile-nav')
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Essential JavaScript Functions -->
    <script>
    // Add to Cart AJAX
    function addToCartAjax(e, form) {
        e.preventDefault();
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn && submitBtn.disabled) return false;
        
        if (submitBtn) {
            submitBtn.disabled = true;
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Adding...';
            
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
            }).then(r => {
                if (!r.ok) {
                    return r.json().then(err => {
                        throw new Error(err.message || 'Network response was not ok');
                    });
                }
                return r.json();
            }).then(data => {
                if (!data || !data.success) {
                    reEnableButton();
                    if (data && data.message && window.Swal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            confirmButtonColor: '#0d6efd'
                        });
                    }
                    return;
                }
                if (data.cart && typeof window.__updateCartCount === 'function') {
                    window.__updateCartCount(data.cart.count);
                }
                if (window.Swal) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Cart!',
                        text: data.message || 'Product added to cart successfully.',
                        confirmButtonColor: '#0d6efd',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }
                reEnableButton();
            }).catch(error => {
                console.error('Add to cart error:', error);
                reEnableButton();
                if (window.Swal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Failed to add item to cart. Please try again.',
                        confirmButtonColor: '#0d6efd'
                    });
                }
            });
        }
        return false;
    }
    
    // Wishlist Toggle
    (function() {
        if (window.__wishlistListenerBound) return;
        window.__wishlistListenerBound = true;
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.wishlist-toggle');
            if (!btn) return;
            e.preventDefault();
            const pid = btn.getAttribute('data-product-id');
            fetch("{{ route('wishlist.toggle') }}", {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin',
                body: JSON.stringify({ product_id: pid })
            }).then(async r => {
                let res = null;
                try { res = await r.json(); } catch(e) {}
                if (!r.ok) throw new Error('Request failed');
                return res;
            }).then(res => {
                if (!res || !res.success) return;
                const icon = btn.querySelector('i');
                if (res.state === 'added') {
                    btn.classList.remove('btn-outline-primary');
                    btn.classList.add('btn-primary');
                    if (icon) {
                        icon.classList.remove('fa-heart');
                        icon.classList.add('fa-heart');
                    }
                } else {
                    btn.classList.add('btn-outline-primary');
                    btn.classList.remove('btn-primary');
                    if (icon) {
                        icon.classList.add('fa-heart');
                        icon.classList.remove('fa-heart');
                    }
                }
            }).catch(error => {
                console.error('Wishlist toggle error:', error);
            });
        });
    })();
    </script>
    
    @stack('scripts')
    
    <!-- Tracking Codes - Body Section -->
    @if(!empty($siteSettings->custom_body_code))
        {!! $siteSettings->custom_body_code !!}
    @endif
</body>
</html>

