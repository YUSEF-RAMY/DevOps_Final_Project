<footer class="bg-dark text-light py-5 d-none d-md-block" id="contact">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                @if(!empty($siteSettings->logo_url))
                    <img src="{{ $siteSettings->logo_url }}" alt="Logo" class="mb-3 rounded" height="60">
                @endif
                <p class="text-secondary">{{ $siteSettings->footer_description ?? 'Our purpose is to sustainably make the pleasure and benefits of quality products accessible to everyone.' }}</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5 class="mb-3 text-white">Head Office</h5>
                @if(!empty($siteSettings->address))
                    <p class="mb-2 text-secondary"><i class="fas fa-map-marker-alt me-2 text-primary"></i>{{ $siteSettings->address }}</p>
                @endif
                @if(!empty($siteSettings->phone))
                    <p class="text-secondary"><i class="fas fa-phone me-2 text-primary"></i>{{ $siteSettings->phone }}</p>
                @endif
            </div>
            <div class="col-lg-4 col-md-6">
                <h5 class="mb-3 text-white">Contact</h5>
                @if(!empty($siteSettings->email))
                    <p class="mb-2 text-secondary"><i class="fas fa-envelope me-2 text-primary"></i>{{ $siteSettings->email }}</p>
                @endif
                @if(!empty($siteSettings->phone))
                    <p class="text-secondary"><i class="fas fa-phone me-2 text-primary"></i>{{ $siteSettings->phone }}</p>
                @endif
            </div>
        </div>
        <hr class="my-4 bg-secondary">
        <div class="text-center">
            <p class="mb-0 text-secondary">&copy; {{ date('Y') }} {{ $siteSettings->site_name ?? 'eCommerce Store' }}. All rights reserved.</p>
        </div>
    </div>
</footer>

