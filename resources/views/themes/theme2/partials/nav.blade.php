<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-bottom border-2 border-info" style="z-index: 1020;">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
            @if(!empty($siteSettings->logo_url))
                <img src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name ?? 'eCommerce Store' }}" height="40" class="me-2">
            @else
                <i class="bi bi-shop me-2"></i>
            @endif
            {{ $siteSettings->site_name ?? 'eCommerce Store' }}
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Search Bar -->
            <form action="{{ route('products.index') }}" method="get" class="d-flex flex-grow-1 mx-3 position-relative">
                <div class="input-group position-relative">
                    <input name="q" 
                           id="product-search-input"
                           value="{{ request('q') }}" 
                           class="form-control search-box" 
                           placeholder="Search products..." 
                           aria-label="Search products"
                           autocomplete="off">
                    <button class="btn btn-info text-white" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                    <!-- Search Results Dropdown -->
                    <div id="search-results" class="position-absolute top-100 start-0 w-100 bg-white border rounded shadow-lg mt-1 d-none" style="z-index: 1050; max-height: 500px; overflow-y: auto;">
                        <div id="search-results-content"></div>
                    </div>
                </div>
            </form>
            <style>
                #search-results {
                    border: 1px solid #dee2e6 !important;
                    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
                    border-radius: 8px;
                }
                .search-result-item {
                    display: flex;
                    align-items: flex-start;
                    padding: 12px 16px;
                    border-bottom: 1px solid #f0f0f0;
                    transition: all 0.2s ease;
                    text-decoration: none !important;
                    color: #212529;
                }
                .search-result-item:last-child {
                    border-bottom: none;
                }
                .search-result-item:hover,
                .search-result-item:focus,
                .search-result-item:active {
                    background-color: #f8f9fa;
                    text-decoration: none !important;
                    color: #212529;
                    outline: none;
                }
                .search-result-item img {
                    width: 70px;
                    height: 70px;
                    object-fit: cover;
                    border-radius: 6px;
                    flex-shrink: 0;
                    border: 1px solid #e9ecef;
                }
                .search-result-info {
                    flex: 1;
                    min-width: 0;
                    padding-left: 12px;
                }
                .search-result-title {
                    font-weight: 600;
                    font-size: 15px;
                    margin-bottom: 4px;
                    color: #212529;
                    line-height: 1.4;
                    text-decoration: none !important;
                }
                .search-result-category {
                    font-size: 12px;
                    color: #6c757d;
                    margin-bottom: 6px;
                    display: flex;
                    align-items: center;
                }
                .search-result-description {
                    font-size: 13px;
                    color: #6c757d;
                    margin-bottom: 8px;
                    line-height: 1.4;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
                .search-result-price {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    flex-wrap: wrap;
                    margin-top: 4px;
                }
                .search-result-price-current {
                    font-weight: 700;
                    font-size: 16px;
                    color: #0d6efd;
                }
                .search-result-price-old {
                    font-size: 13px;
                    color: #6c757d;
                    text-decoration: line-through;
                }
                .search-result-badge {
                    font-size: 11px;
                    padding: 3px 8px;
                    border-radius: 4px;
                    font-weight: 600;
                    white-space: nowrap;
                }
                .badge-sale {
                    background-color: #dc3545;
                    color: white;
                }
                .badge-stock {
                    background-color: #198754;
                    color: white;
                }
                .badge-out-of-stock {
                    background-color: #6c757d;
                    color: white;
                }
                @media (max-width: 991px) {
                    #search-results {
                        position: fixed !important;
                        left: 10px !important;
                        right: 10px !important;
                        width: auto !important;
                        max-width: calc(100vw - 20px);
                    }
                }
                @media (max-width: 768px) {
                    .search-result-item {
                        padding: 10px 12px;
                    }
                    .search-result-item img {
                        width: 60px;
                        height: 60px;
                    }
                    .search-result-title {
                        font-size: 14px;
                    }
                    .search-result-description {
                        font-size: 12px;
                        -webkit-line-clamp: 1;
                    }
                    .search-result-price-current {
                        font-size: 15px;
                    }
                    .search-result-price {
                        gap: 6px;
                    }
                }
            </style>

            <!-- Navigation Links -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ route('home') }}">
                        <i class="bi bi-house me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ route('products.index') }}">
                        <i class="bi bi-grid me-1"></i>Products
                    </a>
                </li>
                @php $wishlistEnabled = (\App\Models\SiteSetting::get()->wishlist_enabled ?? true); @endphp
                @if($wishlistEnabled)
                <li class="nav-item position-relative">
                    @php
                        $wishlistCount = 0;
                        if (auth()->check()) {
                            $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count();
                        } else {
                            $sid = session('wishlist_session_id');
                            if ($sid) {
                                $wishlistCount = \App\Models\GuestWishlist::where('session_id', $sid)->count();
                            }
                        }
                    @endphp
                    @auth
                        <a class="nav-link fw-semibold position-relative" href="{{ route('wishlist.index') }}">
                            <i class="bi bi-heart me-1"></i>Wishlist
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger wishlist-count-badge {{ $wishlistCount > 0 ? '' : 'd-none' }}">
                                {{ $wishlistCount > 0 ? $wishlistCount : '' }}
                                <span class="visually-hidden">items in wishlist</span>
                            </span>
                        </a>
                    @else
                        <a class="nav-link fw-semibold position-relative" href="{{ route('wishlist.index') }}">
                            <i class="bi bi-heart me-1"></i>Wishlist
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger wishlist-count-badge {{ $wishlistCount > 0 ? '' : 'd-none' }}">
                                {{ $wishlistCount > 0 ? $wishlistCount : '' }}
                                <span class="visually-hidden">items in wishlist</span>
                            </span>
                        </a>
                    @endauth
                </li>
                @endif
                    <li class="nav-item">
                        <a class="nav-link fw-semibold position-relative" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart me-1"></i>Cart
                            @php
                                $cartCount = 0;
                                if (auth()->check()) {
                                    $cart = auth()->user()->carts()->whereHas('items')->first();
                                    $cartCount = $cart ? $cart->items->sum('quantity') : 0;
                                } else {
                                    $sessionId = session('cart_session_id');
                                    if ($sessionId) {
                                        $cart = \App\Models\Cart::where('session_id', $sessionId)->with('items')->first();
                                        $cartCount = $cart ? $cart->items->sum('quantity') : 0;
                                    }
                                }
                            @endphp
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count-badge {{ $cartCount > 0 ? '' : 'd-none' }}">
                                {{ $cartCount > 0 ? $cartCount : '' }}
                                <span class="visually-hidden">items in cart</span>
                            </span>
                    </a>
                </li>
            </ul>

				<!-- Currency Switcher removed from frontend navigation -->

                <!-- User Menu -->
                <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-2 fs-5"></i>
                            <span class="fw-semibold">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="bi bi-person me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag me-2"></i>My Orders
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('addresses.index') }}">
                                    <i class="bi bi-geo-alt me-2"></i>Addresses
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-info text-white ms-2 rounded-pill px-4" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i>Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        function updateCartCount(count){
            const badge = document.querySelector('.cart-count-badge');
            if(badge){
                if(count > 0){
                    badge.textContent = count;
                    badge.classList.remove('d-none');
                } else {
                    badge.textContent = '';
                    badge.classList.add('d-none');
                }
            }
            // Update mobile badge
            const mobileBadge = document.querySelector('.cart-count-badge-mobile');
            if(mobileBadge){
                if(count > 0){
                    mobileBadge.textContent = count > 9 ? '9+' : count;
                    mobileBadge.style.display = 'flex';
                } else {
                    mobileBadge.style.display = 'none';
                }
            }
        }
        window.__updateCartCount = updateCartCount;

        function updateWishlistCount(count){
            const badge = document.querySelector('.wishlist-count-badge');
            if(badge){
                if(count > 0){
                    badge.textContent = count;
                    badge.classList.remove('d-none');
                } else {
                    badge.textContent = '';
                    badge.classList.add('d-none');
                }
            }
            // Update mobile badge
            const mobileBadge = document.querySelector('.wishlist-count-badge-mobile');
            if(mobileBadge){
                if(count > 0){
                    mobileBadge.textContent = count > 9 ? '9+' : count;
                    mobileBadge.style.display = 'flex';
                } else {
                    mobileBadge.style.display = 'none';
                }
            }
        }
        window.__updateWishlistCount = updateWishlistCount;

        // Live Search Functionality
        const searchInput = document.getElementById('product-search-input');
        const searchResults = document.getElementById('search-results');
        const searchResultsContent = document.getElementById('search-results-content');
        let searchTimeout = null;

        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.trim();
                
                // Clear previous timeout
                if (searchTimeout) {
                    clearTimeout(searchTimeout);
                }

                // Hide results if query is less than 3 characters
                if (query.length < 3) {
                    searchResults.classList.add('d-none');
                    return;
                }

                // Debounce search - wait 300ms after user stops typing
                searchTimeout = setTimeout(function() {
                    performSearch(query);
                }, 300);
            });

            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                const isClickInside = searchInput.contains(e.target) || searchResults.contains(e.target);
                if (!isClickInside) {
                    searchResults.classList.add('d-none');
                }
            });

            // Hide results on form submit
            const form = searchInput.closest('form');
            if (form) {
                form.addEventListener('submit', function() {
                    searchResults.classList.add('d-none');
                });
            }
        }

        function performSearch(query) {
            // Show loading state
            searchResultsContent.innerHTML = '<div class="p-3 text-center"><div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div><span class="text-muted">Searching...</span></div>';
            searchResults.classList.remove('d-none');
            
            fetch(`{{ route('products.search') }}?q=${encodeURIComponent(query)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                displayResults(data.products, query);
            })
            .catch(error => {
                console.error('Search error:', error);
                searchResultsContent.innerHTML = '<div class="p-3 text-muted text-center"><i class="bi bi-exclamation-triangle me-2"></i>Error loading results</div>';
            });
        }

        function displayResults(products, query) {
            if (products.length === 0) {
                searchResultsContent.innerHTML = '<div class="p-3 text-muted text-center"><i class="bi bi-search me-2"></i>No products found</div>';
                searchResults.classList.remove('d-none');
                return;
            }

            let html = '';
            products.forEach(product => {
                const stockBadge = product.in_stock 
                    ? `<span class="search-result-badge badge-stock">In Stock</span>`
                    : `<span class="search-result-badge badge-out-of-stock">Out of Stock</span>`;
                
                const saleBadge = product.is_on_sale 
                    ? `<span class="search-result-badge badge-sale">-${product.discount_percent}%</span>`
                    : '';
                
                const priceHtml = product.is_on_sale && product.compare_at_price
                    ? `
                        <div class="search-result-price-current">$${product.price}</div>
                        <div class="search-result-price-old">$${product.compare_at_price}</div>
                        ${saleBadge}
                    `
                    : `<div class="search-result-price-current">$${product.price}</div>`;
                
                const categoryHtml = product.category 
                    ? `<div class="search-result-category"><i class="bi bi-tag me-1"></i>${escapeHtml(product.category)}</div>`
                    : '';
                
                const descriptionHtml = product.short_description 
                    ? `<div class="search-result-description">${escapeHtml(product.short_description)}</div>`
                    : '';
                
                html += `
                    <a href="${product.url}" class="search-result-item">
                        <img src="${product.image}" alt="${escapeHtml(product.name)}">
                        <div class="search-result-info">
                            <div class="search-result-title">${escapeHtml(product.name)}</div>
                            ${categoryHtml}
                            ${descriptionHtml}
                            <div class="search-result-price">
                                ${priceHtml}
                                ${stockBadge}
                            </div>
                        </div>
                    </a>
                `;
            });

            // Add "View All Results" link if there are 20 products (likely more available)
            if (products.length === 20) {
                html += `
                    <div class="border-top p-3 text-center bg-light">
                        <a href="{{ route('products.index') }}?q=${encodeURIComponent(query)}" class="btn btn-sm btn-primary">
                            <i class="bi bi-arrow-right me-1"></i>View All Results
                        </a>
                    </div>
                `;
            }

            searchResultsContent.innerHTML = html;
            searchResults.classList.remove('d-none');
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    });
    </script>


