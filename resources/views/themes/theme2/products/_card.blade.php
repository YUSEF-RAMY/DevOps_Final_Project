<div class="card product-card h-100 border-0 shadow-sm position-relative overflow-hidden">
    <div class="position-relative">
        <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
            <div class="card-img-top bg-light d-flex align-items-center justify-content-center product-image-wrapper" style="overflow: hidden;">
            @if($product->images->count() > 0)
                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                     alt="{{ $product->name }}" 
                         class="img-fluid product-image" 
                         style="transition: transform 0.3s ease;">
            @else
                    <i class="bi bi-image text-muted" style="font-size: clamp(2rem, 5vw, 3rem);"></i>
            @endif
        </div>
        </a>
        
        <!-- Badges -->
        <div class="position-absolute top-0 start-0 m-2 d-flex flex-column gap-1" style="z-index: 2; max-width: calc(100% - 60px);">
        @if($product->is_featured)
                <span class="badge bg-warning text-dark" style="max-width: 100%; overflow: hidden; text-overflow: ellipsis;">
                <i class="bi bi-star-fill me-1"></i>Featured
            </span>
        @endif
        @if($product->compare_at_price && $product->compare_at_price > $product->price)
            @php
                $discount = round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100);
            @endphp
                <span class="badge bg-danger" style="max-width: 100%; overflow: hidden; text-overflow: ellipsis;">
                    <i class="bi bi-tag-fill me-1"></i>-{{ $discount }}%
            </span>
        @endif
        </div>

        <!-- Wishlist Button -->
        @php $settings = \App\Models\SiteSetting::get(); @endphp
        @if($settings->wishlist_enabled ?? true)
            <div class="position-absolute top-0 end-0 m-2" style="z-index: 3;">
                @php
                    if (auth()->check()) {
                        $wished = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
                    } else {
                        $sid = session('wishlist_session_id');
                        $wished = $sid ? \App\Models\GuestWishlist::where('session_id', $sid)->where('product_id', $product->id)->exists() : false;
                    }
                @endphp
                <button class="btn btn-sm {{ $wished ? 'btn-danger' : 'btn-outline-danger' }} wishlist-toggle rounded-circle" 
                        data-product-id="{{ $product->id }}" 
                        title="{{ $wished ? 'Remove from wishlist' : 'Add to wishlist' }}"
                        style="width: 38px; height: 38px; padding: 0; display: flex; align-items: center; justify-content: center;">
                    <i class="bi {{ $wished ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                </button>
            </div>
        @endif
    </div>
    
    <div class="card-body d-flex flex-column p-3">
        <!-- Product Title -->
        <h6 class="card-title mb-2">
            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark fw-semibold">
                {{ $product->name }}
            </a>
        </h6>
        
        <!-- Short Description -->
        @if($product->short_description)
            <p class="card-text text-muted small flex-grow-1 mb-2" style="min-height: 40px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                {{ Str::limit($product->short_description, 75) }}
        </p>
        @endif
        
        <!-- Price and Stock -->
        <div class="mb-3">
            <div class="d-flex align-items-baseline gap-2 mb-1">
                <span class="h5 text-primary fw-bold mb-0">@currency($product->price)</span>
                @if($product->compare_at_price && $product->compare_at_price > $product->price)
                    <small class="text-muted text-decoration-line-through">
                            @currency($product->compare_at_price)
                    </small>
                @endif
            </div>
            @if($product->stock > 0)
                <small class="text-success d-block">
                    <i class="bi bi-check-circle me-1"></i>In Stock
                </small>
            @else
                <small class="text-danger d-block">
                    <i class="bi bi-x-circle me-1"></i>Out of Stock
                </small>
            @endif
        </div>
        
            @php
                $cartItem = null;
                if (auth()->check()) {
                    $cart = \App\Models\Cart::where('user_id', auth()->id())->with('items')->first();
                    if ($cart) {
                        $cartItem = $cart->items->firstWhere('product_id', $product->id);
                    }
                } else {
                    $sessionId = session('cart_session_id');
                    if ($sessionId) {
                        $cart = \App\Models\Cart::where('session_id', $sessionId)->with('items')->first();
                        if ($cart) {
                            $cartItem = $cart->items->firstWhere('product_id', $product->id);
                        }
                    }
                }
            @endphp

            @if(request('select') == '1')
                <div class="input-group mb-2">
                    <span class="input-group-text">Qty</span>
                    <input type="number" class="form-control" value="1" min="1" data-select-qty>
                </div>
                <button type="button" class="btn btn-outline-primary w-100 btn-custom" data-select-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-sku="{{ $product->sku }}" data-product-price="{{ number_format(\App\Support\CurrencyManager::convert((float) $product->price), 2, '.', '') }}">
                    <i class="bi bi-check2-circle me-1"></i> Select This Product
                </button>
            @elseif($cartItem)
                <div class="d-grid gap-2" style="min-height: 90px;">
                    <div class="alert alert-success py-2 mb-0 d-flex justify-content-between align-items-center flex-wrap gap-2" data-stock="{{ (int) $product->stock }}" data-item-id="{{ $cartItem->id }}">
                        <div class="d-flex align-items-center flex-shrink-0" style="min-width: 0;">
                            <i class="bi bi-check-circle me-1 flex-shrink-0"></i>
                            <span class="text-nowrap">Carted ({{ $cartItem->quantity }})</span>
                        </div>
                        <div class="d-flex align-items-center gap-1 flex-shrink-0">
                            <form action="{{ route('cart.items.update', $cartItem->id) }}" method="post" class="d-inline" onsubmit="return updateCartItemAjax(event, this)">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ max(1, $cartItem->quantity - 1) }}">
                                <button class="btn btn-sm btn-outline-secondary" {{ $cartItem->quantity <= 1 ? 'disabled' : '' }}>
                                    <i class="bi bi-dash"></i>
                                </button>
                            </form>
                            <form action="{{ route('cart.items.update', $cartItem->id) }}" method="post" class="d-inline" onsubmit="return updateCartItemAjax(event, this)">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ min($product->stock, $cartItem->quantity + 1) }}">
                                <button class="btn btn-sm btn-outline-secondary" {{ $product->stock <= $cartItem->quantity ? 'disabled' : '' }}>
                                    <i class="bi bi-plus"></i>
                                </button>
                            </form>
                            <button class="btn btn-sm btn-outline-danger" title="Remove from cart" data-cart-remove="{{ $cartItem->id }}" data-product-id="{{ $product->id }}" data-stock="{{ (int) $product->stock }}">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    </div>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-primary btn-custom w-100" style="min-height: 38px;">
                        <i class="bi bi-cart"></i> View Cart
                    </a>
                </div>
            @else
                <div class="d-grid gap-2" style="min-height: 90px;">
                    <form action="{{ route('cart.add') }}" method="post" onsubmit="return addToCartAjax(event, this)" class="mb-0">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="btn btn-primary w-100 btn-custom" 
                                {{ $product->stock <= 0 ? 'disabled' : '' }}
                                style="min-height: 38px;">
                        <i class="bi bi-cart-plus me-2"></i>
                        {{ $product->stock <= 0 ? 'Out of Stock' : 'Add to Cart' }}
                    </button>
                </form>
                </div>
            @endif
    </div>
</div>

<script>
function addToCartAjax(e, form){
    e.preventDefault();
    
    // Prevent multiple simultaneous requests
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn && submitBtn.disabled) {
        return false;
    }
    
    // Disable button and show loading state
    if (submitBtn) {
        submitBtn.disabled = true;
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Adding...';
        
        // Re-enable button on error
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
        }).then(r=>{
            if (!r.ok) {
                return r.json().then(err => {
                    throw new Error(err.message || 'Network response was not ok');
                }).catch(() => {
                    throw new Error('Network response was not ok');
                });
            }
            return r.json();
        }).then(data=>{
            if(!data || !data.success) {
                reEnableButton();
                // Show error message if available
                if(data && data.message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonColor: '#20c997'
                    });
                }
                return;
            }
            if(data.cart && typeof window.__updateCartCount === 'function'){
                window.__updateCartCount(data.cart.count);
            }
            // Swap UI to show carted state with +/- without reload
            const card = form.closest('.card');
            const wrapper = document.createElement('div');
            wrapper.className = 'd-grid gap-2';
            wrapper.style.minHeight = '90px';
            wrapper.innerHTML = `
                <div class="alert alert-success py-2 mb-0 d-flex justify-content-between align-items-center flex-wrap gap-2" data-stock="{{ (int) $product->stock }}" data-item-id="${data.item.id}">
                    <div class="d-flex align-items-center flex-shrink-0" style="min-width: 0;">
                        <i class="bi bi-check-circle me-1 flex-shrink-0"></i>
                        <span class="text-nowrap">Carted (${data.item.quantity})</span>
                    </div>
                    <div class="d-flex align-items-center gap-1 flex-shrink-0">
                        <button class="btn btn-sm btn-outline-secondary" data-qty-change="-1"><i class="bi bi-dash"></i></button>
                        <button class="btn btn-sm btn-outline-secondary" data-qty-change="1"><i class="bi bi-plus"></i></button>
                        <button class="btn btn-sm btn-outline-danger" title="Remove from cart" data-cart-remove="${data.item.id}" data-product-id="{{ $product->id }}" data-stock="{{ (int) $product->stock }}">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-primary btn-custom w-100 js-view-cart-btn" style="min-height: 38px;">
                    <i class="bi bi-cart"></i> View Cart
                </a>
            `;
            form.parentNode.replaceChild(wrapper, form);
            const changeQty = (delta)=>{
                const itemId = data.item.id;
                const newQty = Math.max(1, data.item.quantity + delta);
                fetch(`{{ url('/cart/items') }}/${itemId}`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: new URLSearchParams({ _method: 'PUT', quantity: newQty })
                }).then(r=>r.json()).then(res=>{
                    if(!res || !res.success) return;
                    data.item.quantity = res.item.quantity;
                    const cartedText = wrapper.querySelector('.alert .text-nowrap');
                    if (cartedText) {
                        cartedText.textContent = `Carted (${res.item.quantity})`;
                    }
                    if(typeof window.__updateCartCount === 'function'){
                        window.__updateCartCount(res.cart.count);
                    }
                });
            };
            wrapper.querySelector('[data-qty-change="-1"]').addEventListener('click', (ev)=>{ ev.preventDefault(); changeQty(-1); });
            wrapper.querySelector('[data-qty-change="1"]').addEventListener('click', (ev)=>{ ev.preventDefault(); changeQty(1); });
        }).catch((error)=>{
            console.error('Add to cart error:', error);
            reEnableButton();
            // Show user-friendly error message
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Failed to add item to cart. Please try again.',
                confirmButtonColor: '#20c997'
            });
        });
    } else {
        // Fallback if button not found
    const fd = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
        },
        body: fd
    }).then(r=>r.json()).then(data=>{
        if(!data || !data.success) return;
        if(data.cart && typeof window.__updateCartCount === 'function'){
            window.__updateCartCount(data.cart.count);
        }
        // Swap UI to show carted state with +/- without reload
        const card = form.closest('.card');
        const wrapper = document.createElement('div');
        wrapper.className = 'd-grid gap-2';
            wrapper.style.minHeight = '90px';
        wrapper.innerHTML = `
                <div class="alert alert-success py-2 mb-0 d-flex justify-content-between align-items-center flex-wrap gap-2" data-stock="{{ (int) $product->stock }}" data-item-id="${data.item.id}">
                    <div class="d-flex align-items-center flex-shrink-0" style="min-width: 0;">
                        <i class="bi bi-check-circle me-1 flex-shrink-0"></i>
                        <span class="text-nowrap">Carted (${data.item.quantity})</span>
                </div>
                    <div class="d-flex align-items-center gap-1 flex-shrink-0">
                    <button class="btn btn-sm btn-outline-secondary" data-qty-change="-1"><i class="bi bi-dash"></i></button>
                    <button class="btn btn-sm btn-outline-secondary" data-qty-change="1"><i class="bi bi-plus"></i></button>
                    <button class="btn btn-sm btn-outline-danger" title="Remove from cart" data-cart-remove="${data.item.id}" data-product-id="{{ $product->id }}" data-stock="{{ (int) $product->stock }}">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-primary btn-custom w-100 js-view-cart-btn" style="min-height: 38px;">
                <i class="bi bi-cart"></i> View Cart
            </a>
        `;
        form.parentNode.replaceChild(wrapper, form);
        const changeQty = (delta)=>{
            const itemId = data.item.id;
            const newQty = Math.max(1, data.item.quantity + delta);
            fetch(`{{ url('/cart/items') }}/${itemId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: new URLSearchParams({ _method: 'PUT', quantity: newQty })
            }).then(r=>r.json()).then(res=>{
                if(!res || !res.success) return;
                data.item.quantity = res.item.quantity;
                    const cartedText = wrapper.querySelector('.alert .text-nowrap');
                    if (cartedText) {
                        cartedText.textContent = `Carted (${res.item.quantity})`;
                    }
                if(typeof window.__updateCartCount === 'function'){
                    window.__updateCartCount(res.cart.count);
                }
            });
        };
        wrapper.querySelector('[data-qty-change="-1"]').addEventListener('click', (ev)=>{ ev.preventDefault(); changeQty(-1); });
        wrapper.querySelector('[data-qty-change="1"]').addEventListener('click', (ev)=>{ ev.preventDefault(); changeQty(1); });
        }).catch((error)=>{
            console.error('Add to cart error:', error);
        });
    }
    return false;
}

function updateCartItemAjax(e, form){
    e.preventDefault();
    const token = form.querySelector('input[name="_token"]').value;
    const qty = form.querySelector('input[name="quantity"]').value;
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: new URLSearchParams({ _method: 'PUT', quantity: qty })
    }).then(r=>r.json()).then(res=>{
        if(!res || !res.success) return false;
        if(typeof window.__updateCartCount === 'function'){
            window.__updateCartCount(res.cart.count);
        }
        const alertBox = form.closest('.alert');
        if(alertBox){
            // Update the text
            const cartedText = alertBox.querySelector('.text-nowrap');
            if (cartedText) {
                cartedText.textContent = `Carted (${res.item.quantity})`;
            }
            // Update the +/- forms hidden values and disabled state
            const stock = parseInt(alertBox.dataset.stock || '999999', 10);
            const forms = alertBox.querySelectorAll('form');
            if(forms.length >= 2){
                const minusForm = forms[0];
                const plusForm = forms[1];
                const newQty = parseInt(res.item.quantity, 10);
                const minusInput = minusForm.querySelector('input[name="quantity"]');
                const plusInput = plusForm.querySelector('input[name="quantity"]');
                if(minusInput){ minusInput.value = Math.max(1, newQty - 1); }
                if(plusInput){ plusInput.value = Math.min(stock, newQty + 1); }
                // Toggle disabled buttons
                const minusBtn = minusForm.querySelector('button');
                const plusBtn = plusForm.querySelector('button');
                if(minusBtn){ minusBtn.disabled = newQty <= 1; }
                if(plusBtn){ plusBtn.disabled = newQty >= stock; }
            }
        }
    }).catch(()=>{});
    return false;
}

</script>

 


