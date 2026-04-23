<footer class="footer mt-auto bg-dark">
    <div class="container py-5">
        <div class="row">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-white mb-3">
                    <i class="bi bi-shop me-2"></i>{{ $siteSettings->site_name ?? 'eCommerce Store' }}
                </h5>
                <p class="text-light mb-3">
                    Your one-stop destination for quality products at great prices. 
                    We're committed to providing excellent service and fast delivery.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ $siteSettings->social_facebook ?? '#' }}" class="text-light fs-4">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="{{ $siteSettings->social_twitter ?? '#' }}" class="text-light fs-4">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="{{ $siteSettings->social_instagram ?? '#' }}" class="text-light fs-4">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="{{ $siteSettings->social_linkedin ?? '#' }}" class="text-light fs-4">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-white mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-light text-decoration-none">
                            <i class="bi bi-house me-1"></i>Home
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('products.index') }}" class="text-light text-decoration-none">
                            <i class="bi bi-grid me-1"></i>Products
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('cart.index') }}" class="text-light text-decoration-none">
                            <i class="bi bi-cart me-1"></i>Cart
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('orders.index') }}" class="text-light text-decoration-none">
                            <i class="bi bi-bag me-1"></i>Orders
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-white mb-3">Customer Service</h6>
                <ul class="list-unstyled">
                    @php
                        $helpCenterPage = \App\Models\Page::where('slug', 'help-center')->where('is_active', true)->first();
                        $shippingInfoPage = \App\Models\Page::where('slug', 'shipping-info')->where('is_active', true)->first();
                        $returnsPage = \App\Models\Page::where('slug', 'returns')->where('is_active', true)->first();
                        $contactUsPage = \App\Models\Page::where('slug', 'contact-us')->where('is_active', true)->first();
                    @endphp
                    <li class="mb-2">
                        <a href="{{ $helpCenterPage ? route('pages.show', $helpCenterPage->slug) : ($siteSettings->help_center_url ?? '#') }}" class="text-light text-decoration-none">
                            <i class="bi bi-question-circle me-1"></i>Help Center
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ $shippingInfoPage ? route('pages.show', $shippingInfoPage->slug) : ($siteSettings->shipping_info_url ?? '#') }}" class="text-light text-decoration-none">
                            <i class="bi bi-truck me-1"></i>Shipping Info
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ $returnsPage ? route('pages.show', $returnsPage->slug) : ($siteSettings->returns_url ?? '#') }}" class="text-light text-decoration-none">
                            <i class="bi bi-arrow-clockwise me-1"></i>Returns
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ $contactUsPage ? route('pages.show', $contactUsPage->slug) : ($siteSettings->contact_us_url ?? '#') }}" class="text-light text-decoration-none">
                            <i class="bi bi-telephone me-1"></i>Contact Us
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Account -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-white mb-3">My Account</h6>
                <ul class="list-unstyled">
                    @auth
                        <li class="mb-2">
                            <a href="{{ route('profile') }}" class="text-light text-decoration-none">
                                <i class="bi bi-person me-1"></i>Profile
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('orders.index') }}" class="text-light text-decoration-none">
                                <i class="bi bi-bag me-1"></i>Order History
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('addresses.index') }}" class="text-light text-decoration-none">
                                <i class="bi bi-geo-alt me-1"></i>Addresses
                            </a>
                        </li>
                    @else
                        <li class="mb-2">
                            <a href="{{ route('login') }}" class="text-light text-decoration-none">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('register') }}" class="text-light text-decoration-none">
                                <i class="bi bi-person-plus me-1"></i>Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Newsletter -->
            @php $newsletterEnabled = ($siteSettings->newsletter_enabled ?? true); @endphp
            @if($newsletterEnabled)
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="text-white mb-3">Newsletter</h6>
                    <p class="text-light mb-3">Subscribe for updates and special offers!</p>
                    <form class="d-flex newsletter-subscribe-form" action="{{ route('newsletter.subscribe') }}" method="post">
                        @csrf
                        <input type="hidden" name="source" value="footer">
                        <input type="email" name="email" class="form-control form-control-sm me-2 rounded-pill" placeholder="Your email" required>
                        <button class="btn btn-info btn-sm text-white rounded-pill" type="submit">
                            <i class="bi bi-send"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <hr class="my-4 border-info opacity-50">

        <!-- Bottom Footer -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="text-light mb-0">
                    &copy; {{ date('Y') }} {{ $siteSettings->footer_text ?? ($siteSettings->site_name ?? 'eCommerce Store') . '. All rights reserved.' }}
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex justify-content-md-end gap-3">
                    <a href="{{ $siteSettings->privacy_url ?? '#' }}" class="text-light text-decoration-none">Privacy Policy</a>
                    <a href="{{ $siteSettings->terms_url ?? '#' }}" class="text-light text-decoration-none">Terms of Service</a>
                    <a href="{{ $siteSettings->cookies_url ?? '#' }}" class="text-light text-decoration-none">Cookies</a>
                </div>
            </div>
        </div>
    </div>
</footer>


