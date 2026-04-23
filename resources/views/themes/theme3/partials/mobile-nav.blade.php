<div class="d-md-none fixed-bottom bg-white border-top shadow-lg">
    <div class="container">
        <div class="row text-center py-2">
            <div class="col-3">
                <a href="{{ route('home') }}" class="text-decoration-none {{ request()->routeIs('home') ? 'text-primary' : 'text-dark' }} d-flex flex-column align-items-center py-2">
                    <i class="fas fa-home fa-lg mb-1"></i>
                    <small class="small">Home</small>
                </a>
            </div>
            <div class="col-3">
                <a href="{{ route('products.index') }}" class="text-decoration-none {{ request()->routeIs('products.*') ? 'text-primary' : 'text-dark' }} d-flex flex-column align-items-center py-2">
                    <i class="fas fa-th fa-lg mb-1"></i>
                    <small class="small">Products</small>
                </a>
            </div>
            <div class="col-3">
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
                <a href="{{ route('cart.index') }}" class="text-decoration-none {{ request()->routeIs('cart.*') ? 'text-primary' : 'text-dark' }} d-flex flex-column align-items-center py-2 position-relative">
                    <i class="fas fa-shopping-cart fa-lg mb-1"></i>
                    <small class="small">Cart</small>
                    <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger" id="cartCountMobile" style="font-size: 0.6rem; {{ $cartCount > 0 ? '' : 'display: none;' }}">{{ $cartCount > 0 ? ($cartCount > 9 ? '9+' : $cartCount) : '0' }}</span>
                </a>
            </div>
            <div class="col-3">
                @auth
                    <a href="{{ route('profile') }}" class="text-decoration-none {{ request()->routeIs('profile') ? 'text-primary' : 'text-dark' }} d-flex flex-column align-items-center py-2">
                        <i class="fas fa-user fa-lg mb-1"></i>
                        <small class="small">Account</small>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-decoration-none {{ request()->routeIs('login') ? 'text-primary' : 'text-dark' }} d-flex flex-column align-items-center py-2">
                        <i class="fas fa-user fa-lg mb-1"></i>
                        <small class="small">Account</small>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

