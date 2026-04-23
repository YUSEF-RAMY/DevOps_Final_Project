<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            @if(!empty($siteSettings->logo_url))
                <img src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name ?? 'eCommerce Store' }}" height="50" class="rounded">
            @else
                {{ $siteSettings->site_name ?? 'eCommerce Store' }}
            @endif
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }} fw-semibold" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }} fw-semibold" href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ route('home') }}#about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ route('home') }}#contact">Contact</a>
                </li>
                <li class="nav-item">
                    @auth
                        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }} fw-semibold" href="{{ route('profile') }}">Account</a>
                    @else
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }} fw-semibold" href="{{ route('login') }}">Account</a>
                    @endauth
                </li>
                <li class="nav-item ms-3">
                    @php
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
                    @endphp
                    <a class="nav-link position-relative {{ request()->routeIs('cart.*') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart fa-lg text-primary"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count-badge" id="cartCount" style="{{ $cartCount > 0 ? '' : 'display: none;' }}">{{ $cartCount }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    function updateCartCount(count) {
        const badge = document.getElementById('cartCount');
        if (badge) {
            if (count > 0) {
                badge.textContent = count;
                badge.style.display = '';
            } else {
                badge.textContent = '0';
                badge.style.display = 'none';
            }
        }
        const mobileBadge = document.getElementById('cartCountMobile');
        if (mobileBadge) {
            if (count > 0) {
                mobileBadge.textContent = count > 9 ? '9+' : count;
                mobileBadge.style.display = '';
            } else {
                mobileBadge.textContent = '0';
                mobileBadge.style.display = 'none';
            }
        }
    }
    window.__updateCartCount = updateCartCount;
</script>

