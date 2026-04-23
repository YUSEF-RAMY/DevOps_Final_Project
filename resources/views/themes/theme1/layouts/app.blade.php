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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
        /* Remove underline from all links */
        a {
            text-decoration: none !important;
        }
        a:hover {
            text-decoration: none !important;
        }
        a:focus {
            text-decoration: none !important;
        }
        a:visited {
            text-decoration: none !important;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .footer {
            background-color: #2c3e50;
            color: white;
        }
        .btn-custom {
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
        }
        .search-box {
            border-radius: 25px;
            border: 2px solid #e9ecef;
        }
        .search-box:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        /* Mobile Bottom Navigation */
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            background: white;
            border-top: 1px solid #e9ecef;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            padding-bottom: env(safe-area-inset-bottom);
        }
        .mobile-nav-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 0.4rem 0.25rem;
            max-width: 100%;
        }
        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #6c757d;
            padding: 0.35rem 0.75rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            min-width: 50px;
            position: relative;
        }
        .mobile-nav-item i {
            font-size: 1.25rem;
            margin-bottom: 0.15rem;
            transition: all 0.3s ease;
        }
        .mobile-nav-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            line-height: 1;
        }
        .mobile-nav-item:hover,
        .mobile-nav-item:active,
        .mobile-nav-item:focus {
            color: #667eea;
            text-decoration: none;
            background: rgba(102, 126, 234, 0.1);
        }
        .mobile-nav-item:hover i,
        .mobile-nav-item:active i {
            transform: scale(1.1);
            color: #667eea;
        }
        .mobile-nav-badge {
            font-size: 0.6rem;
            padding: 0.15rem 0.35rem;
            min-width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
            top: -1px;
            right: -1px;
        }
        /* Add padding to body to prevent content from being hidden behind bottom nav */
        @media (max-width: 767.98px) {
            body {
                padding-bottom: 60px;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    @include('themes.theme1.partials.nav')
    
    <main class="flex-grow-1">
        <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        </div>

        @yield('content')
    </main>
    
    @include('themes.theme1.partials.footer')
    
    <!-- Mobile Floating Bottom Navigation -->
    <div class="mobile-bottom-nav d-md-none">
        <div class="mobile-nav-container">
            @php
                // Get cart count
                $cartCount = 0;
                if (auth()->check()) {
                    $cart = \App\Models\Cart::where('user_id', auth()->id())->with('items')->first();
                    if ($cart) {
                        $cartCount = $cart->items->sum('quantity');
                    }
                } else {
                    $sessionId = session('cart_session_id');
                    if ($sessionId) {
                        $cart = \App\Models\Cart::where('session_id', $sessionId)->with('items')->first();
                        if ($cart) {
                            $cartCount = $cart->items->sum('quantity');
                        }
                    }
                }
                
                // Get wishlist count
                $wishlistCount = 0;
                $wishlistEnabled = (\App\Models\SiteSetting::get()->wishlist_enabled ?? true);
                if ($wishlistEnabled) {
                    if (auth()->check()) {
                        $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count();
                    } else {
                        $sid = session('wishlist_session_id');
                        if ($sid) {
                            $wishlistCount = \App\Models\GuestWishlist::where('session_id', $sid)->count();
                        }
                    }
                }
            @endphp
            
            <a href="{{ auth()->check() ? route('profile') : route('login') }}" class="mobile-nav-item">
                <i class="bi bi-person-circle"></i>
                <span class="mobile-nav-label">{{ auth()->check() ? 'Account' : 'Login' }}</span>
            </a>
            
            @if($wishlistEnabled)
            <a href="{{ route('wishlist.index') }}" class="mobile-nav-item position-relative">
                <i class="bi bi-heart"></i>
                <span class="mobile-nav-label">Wishlist</span>
                @if($wishlistCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mobile-nav-badge wishlist-count-badge-mobile">
                        {{ $wishlistCount > 9 ? '9+' : $wishlistCount }}
                    </span>
                @endif
            </a>
            @endif
            
            <a href="{{ route('cart.index') }}" class="mobile-nav-item position-relative">
                <i class="bi bi-cart3"></i>
                <span class="mobile-nav-label">Cart</span>
                @if($cartCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mobile-nav-badge cart-count-badge-mobile">
                        {{ $cartCount > 9 ? '9+' : $cartCount }}
                    </span>
                @endif
            </a>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Replace all confirm() calls with SweetAlert2
    (function() {
        function replaceFormConfirms() {
            // Handle forms with onsubmit="return confirm()"
            document.querySelectorAll('form[onsubmit*="confirm"]').forEach(form => {
                const originalOnsubmit = form.getAttribute('onsubmit');
                if (originalOnsubmit && originalOnsubmit.includes('confirm')) {
                    const match = originalOnsubmit.match(/confirm\(['"]([^'"]+)['"]\)/);
                    const confirmMessage = match ? match[1] : 'Are you sure?';
                    
                    form.removeAttribute('onsubmit');
                    
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const formElement = this;
                        
                        Swal.fire({
                            icon: 'warning',
                            title: 'Confirm Action',
                            text: confirmMessage,
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, Continue',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                formElement.removeEventListener('submit', arguments.callee);
                                formElement.submit();
                            }
                        });
                    });
                }
            });
            
            // Handle buttons with onclick="return confirm()"
            document.querySelectorAll('button[onclick*="confirm"], input[type="submit"][onclick*="confirm"]').forEach(btn => {
                const originalOnclick = btn.getAttribute('onclick');
                if (originalOnclick && originalOnclick.includes('confirm')) {
                    const match = originalOnclick.match(/confirm\(['"]([^'"]+)['"]\)/);
                    const confirmMessage = match ? match[1] : 'Are you sure?';
                    
                    btn.removeAttribute('onclick');
                    
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const buttonElement = this;
                        const form = buttonElement.closest('form');
                        
                        Swal.fire({
                            icon: 'warning',
                            title: 'Confirm Action',
                            text: confirmMessage,
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, Continue',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (form) {
                                    form.submit();
                                } else {
                                    buttonElement.click();
                                }
                            }
                        });
                    });
                }
            });
        }
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', replaceFormConfirms);
        } else {
            replaceFormConfirms();
        }
        
        setTimeout(replaceFormConfirms, 500);
    })();
    </script>
    <script>
    (function(){
        if(window.__wishlistListenerBound) return; // avoid duplicates
        window.__wishlistListenerBound = true;
        document.addEventListener('click', function(e){
            const btn = e.target.closest('.wishlist-toggle');
            if(!btn) return;
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
            }).then(async r=>{
                let res = null;
                try { res = await r.json(); } catch(e) {}
                if(!r.ok) throw new Error('Request failed');
                return res;
            }).then(res=>{
                if(!res || !res.success) return;
                
                // Check if we're on a product detail page (URL contains /products/ and is not just /products)
                const isProductDetailPage = window.location.pathname.match(/^\/products\/[^\/]+$/);
                
                // Determine button type: product card (icon only) or product detail (icon + text)
                const icon = btn.querySelector('i');
                const label = btn.querySelector('span');
                // Check if button has text content (product detail page buttons have "Add to Wishlist" text)
                // Icon-only buttons (product cards) only have the icon element, no text nodes
                const buttonText = btn.textContent.trim().toLowerCase();
                const hasWishlistText = buttonText.includes('wishlist') || buttonText.includes('add') || buttonText.includes('remove');
                // Icon-only buttons: have only one child (the icon) and no wishlist text
                const isIconOnlyButton = !hasWishlistText && icon && btn.children.length === 1;
                
                if(res.state === 'added'){
                    btn.classList.remove('btn-outline-danger');
                    btn.classList.add('btn-danger');
                    btn.setAttribute('title', 'Remove from wishlist');
                    
                    if(isIconOnlyButton){
                        // Product card button - icon only, update icon classes
                        if(icon){
                            icon.classList.remove('bi-heart');
                            icon.classList.add('bi-heart-fill');
                        }
                    } else if(label){
                        // Button with span wrapper - update span and icon
                        label.textContent = 'Remove from Wishlist';
                        if(icon){
                            icon.classList.remove('bi-heart');
                            icon.classList.add('bi-heart-fill');
                        }
                    } else {
                        // Product detail page button - icon + text, no span - update entire innerHTML
                        btn.innerHTML = '<i class="bi bi-heart-fill me-2"></i> Remove from Wishlist';
                    }
                    
                    // Show success notification only on product detail page
                    if (isProductDetailPage && window.Swal) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Wishlist!',
                            text: 'Product has been added to your wishlist.',
                            confirmButtonColor: '#667eea',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    }
                } else {
                    btn.classList.add('btn-outline-danger');
                    btn.classList.remove('btn-danger');
                    btn.setAttribute('title', 'Add to wishlist');
                    
                    if(isIconOnlyButton){
                        // Product card button - icon only, update icon classes
                        if(icon){
                            icon.classList.remove('bi-heart-fill');
                            icon.classList.add('bi-heart');
                        }
                    } else if(label){
                        // Button with span wrapper - update span and icon
                        label.textContent = 'Add to Wishlist';
                        if(icon){
                            icon.classList.remove('bi-heart-fill');
                            icon.classList.add('bi-heart');
                        }
                    } else {
                        // Product detail page button - icon + text, no span - update entire innerHTML
                        btn.innerHTML = '<i class="bi bi-heart me-2"></i> Add to Wishlist';
                    }
                    
                    // Show success notification only on product detail page
                    if (isProductDetailPage && window.Swal) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Removed from Wishlist',
                            text: 'Product has been removed from your wishlist.',
                            confirmButtonColor: '#667eea',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    }
                }
                
                if(typeof window.__updateWishlistCount === 'function' && typeof res.count !== 'undefined'){
                    window.__updateWishlistCount(res.count);
                }
            }).catch((error)=>{
                console.error('Wishlist toggle error:', error);
                if (window.Swal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update wishlist. Please try again.',
                        confirmButtonColor: '#667eea'
                    });
                }
            });
        });
    })();
    (function(){
        if(window.__cartRemoveListenerBound) return; // avoid duplicates
        window.__cartRemoveListenerBound = true;
        document.addEventListener('click', function(e){
            const btn = e.target.closest('[data-cart-remove]');
            if(!btn) return;
            e.preventDefault();
            const itemId = btn.getAttribute('data-cart-remove');
            const pid = btn.getAttribute('data-product-id');
            const stock = parseInt(btn.getAttribute('data-stock') || '0', 10);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`${window.location.origin}/cart/items/${itemId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: new URLSearchParams({ _method: 'DELETE' })
            }).then(r=>r.json()).then(res=>{
                if(!res || !res.success) return;
                if(typeof window.__updateCartCount === 'function'){
                    window.__updateCartCount(res.cart.count);
                }
                const alertBox = btn.closest('.alert.alert-success');
                if(alertBox){
                    const container = alertBox.closest('.card-body') || alertBox.parentNode;
                    container && container.querySelectorAll('.js-view-cart-btn').forEach(n=>n.remove());
                    const wrapper = document.createElement('div');
                    wrapper.innerHTML = `
                        <form action="{{ route('cart.add') }}" method="post" onsubmit="return addToCartAjax(event, this)">
                            <input type="hidden" name="_token" value="${token}">
                            <input type="hidden" name="product_id" value="${pid}">
                            <button class="btn btn-primary w-100 btn-custom" ${stock <= 0 ? 'disabled' : ''}>
                                <i class="bi bi-cart-plus me-2"></i>
                                ${stock <= 0 ? 'Out of Stock' : 'Add to Cart'}
                            </button>
                        </form>`;
                    const formNode = wrapper.firstElementChild;
                    alertBox.parentNode.replaceChild(formNode, alertBox);
                }
            }).catch(()=>{});
        });
    })();
    
    // Newsletter subscription with AJAX and SweetAlert
    (function(){
        if(window.__newsletterListenerBound) return;
        window.__newsletterListenerBound = true;
        
        document.addEventListener('submit', function(e){
            const form = e.target.closest('.newsletter-subscribe-form');
            if(!form) return;
            
            e.preventDefault();
            
            const submitBtn = form.querySelector('button[type="submit"]');
            const emailInput = form.querySelector('input[type="email"]');
            const originalBtnText = submitBtn.innerHTML;
            
            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Subscribing...';
            
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || 'Request failed');
                    });
                }
                return response.json();
            })
            .then(data => {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
                
                // Clear email input on success
                if (data.success) {
                    emailInput.value = '';
                }
                
                // Show SweetAlert
                if (window.Swal) {
                    Swal.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.success ? 'Success!' : 'Error',
                        text: data.message || (data.success ? 'Subscribed successfully!' : 'Something went wrong.'),
                        confirmButtonColor: '#667eea',
                        timer: data.success ? 3000 : null,
                        timerProgressBar: data.success
                    });
                } else {
                    Swal.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.success ? 'Success!' : 'Error',
                        text: data.message || (data.success ? 'Subscribed successfully!' : 'Something went wrong.'),
                        confirmButtonColor: '#667eea',
                        timer: data.success ? 3000 : null,
                        timerProgressBar: data.success
                    });
                }
            })
            .catch(error => {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
                
                // Show error with SweetAlert
                if (window.Swal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'An error occurred. Please try again.',
                        confirmButtonColor: '#667eea'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'An error occurred. Please try again.',
                        confirmButtonColor: '#667eea'
                    });
                }
            });
        });
    })();
    </script>
    @stack('scripts')
    
    <!-- Tracking Codes - Body Section (Before closing tag) -->
    @if(!empty($siteSettings->custom_body_code))
        {!! $siteSettings->custom_body_code !!}
    @endif
</body>
</html>


