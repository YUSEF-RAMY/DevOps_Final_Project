@extends('admin.layouts.app')

@section('title', 'Site Settings')

@php
use Illuminate\Support\Facades\Schema;
@endphp

@push('styles')
<style>
  /* Site Settings Tabs Styling */
  .settings-tabs {
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 1.5rem;
  }
  .settings-tabs .nav-link {
    color: #6c757d;
    font-weight: 500;
    padding: 0.75rem 1.25rem;
    border: none;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
    position: relative;
  }
  .settings-tabs .nav-link:hover {
    color: #667eea;
    background-color: rgba(102, 126, 234, 0.05);
    border-bottom-color: rgba(102, 126, 234, 0.3);
  }
  .settings-tabs .nav-link.active {
    color: #667eea;
    background-color: transparent;
    border-bottom-color: #667eea;
    font-weight: 600;
  }
  .settings-tabs .nav-link i {
    margin-right: 0.5rem;
    font-size: 1.1rem;
  }
  .tab-content {
    padding: 0;
  }
  .tab-pane {
    animation: fadeIn 0.3s ease-in;
  }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .settings-section {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e9ecef;
  }
  .settings-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
  }
  .settings-section h5 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f0f0f0;
  }
  .settings-section h5 i {
    color: #667eea;
    margin-right: 0.5rem;
  }
  .form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
  }
  .form-control:focus,
  .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
  }
  .input-group-text {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    color: #667eea;
  }
  .form-check-switch {
    padding: 1rem;
    background-color: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 0.75rem;
    transition: all 0.3s ease;
  }
  .form-check-switch:hover {
    background-color: #e9ecef;
  }
  .form-check-switch .form-check-input {
    margin-top: 0.25rem;
  }
  .form-check-switch .form-check-label {
    margin-left: 0.5rem;
  }
  .form-check-switch strong {
    color: #2c3e50;
    display: block;
    margin-bottom: 0.25rem;
  }
  .form-check-switch small {
    color: #6c757d;
  }
  @media (max-width: 768px) {
    .settings-tabs {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }
    .settings-tabs .nav {
      flex-wrap: nowrap;
      min-width: max-content;
    }
    .settings-tabs .nav-link {
      white-space: nowrap;
      padding: 0.75rem 1rem;
      font-size: 0.9rem;
    }
    .settings-tabs .nav-link i {
      font-size: 1rem;
    }
  }
</style>
@endpush

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
      <h3 class="card-title mb-0 fw-semibold">Configure Site Settings</h3>
    </div>
    <div class="card-body p-0">
      @php $activeTab = request('tab', 'general'); if (!in_array($activeTab, ['general','features','seo','theme','tracking'])) { $activeTab = 'general'; } @endphp
      <form method="POST" action="{{ route('admin.site-settings.update') }}" id="siteSettingsForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="active_tab" id="activeTabInput" value="{{ $activeTab }}">
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs settings-tabs px-3 pt-3" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'general' ? 'active' : '' }}" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="{{ $activeTab === 'general' }}">
              <i class="bi bi-info-circle"></i>General
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'features' ? 'active' : '' }}" id="features-tab" data-bs-toggle="tab" data-bs-target="#features" type="button" role="tab" aria-controls="features" aria-selected="{{ $activeTab === 'features' }}">
              <i class="bi bi-toggle-on"></i>Features
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'seo' ? 'active' : '' }}" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="{{ $activeTab === 'seo' }}">
              <i class="bi bi-search"></i>SEO & Sitemap
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'theme' ? 'active' : '' }}" id="theme-tab" data-bs-toggle="tab" data-bs-target="#theme" type="button" role="tab" aria-controls="theme" aria-selected="{{ $activeTab === 'theme' }}">
              <i class="bi bi-palette"></i>Theme
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'tracking' ? 'active' : '' }}" id="tracking-tab" data-bs-toggle="tab" data-bs-target="#tracking" type="button" role="tab" aria-controls="tracking" aria-selected="{{ $activeTab === 'tracking' }}">
              <i class="bi bi-graph-up"></i>Tracking Codes
            </button>
          </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content p-4" id="settingsTabContent">

          <!-- General Tab -->
          <div class="tab-pane fade {{ $activeTab === 'general' ? 'show active' : '' }}" id="general" role="tabpanel" aria-labelledby="general-tab">
            <!-- Basic Site Information -->
            <div class="settings-section">
              <h5><i class="bi bi-info-circle"></i>Basic Site Information</h5>
              <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Site Name <span class="text-danger">*</span></label>
              <input type="text" name="site_name" class="form-control @error('site_name') is-invalid @enderror" value="{{ old('site_name', $settings->site_name) }}" required placeholder="Enter site name">
              @error('site_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Tagline</label>
              <input type="text" name="site_tagline" class="form-control @error('site_tagline') is-invalid @enderror" value="{{ old('site_tagline', $settings->site_tagline) }}" placeholder="Enter site tagline">
              @error('site_tagline')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Logo URL</label>
              <input type="text" name="logo_url" class="form-control @error('logo_url') is-invalid @enderror" value="{{ old('logo_url', $settings->logo_url) }}" placeholder="https://example.com/logo.png">
              @error('logo_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Favicon URL</label>
              <input type="text" name="favicon_url" class="form-control @error('favicon_url') is-invalid @enderror" value="{{ old('favicon_url', $settings->favicon_url) }}" placeholder="https://example.com/favicon.ico">
              @error('favicon_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
              </div>
            </div>

            <!-- SEO Settings -->
            <div class="settings-section">
              <h5><i class="bi bi-search"></i>SEO Settings</h5>
              <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Meta Title</label>
              <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $settings->meta_title) }}" placeholder="Default page title">
              @error('meta_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Meta Keywords</label>
              <input type="text" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" value="{{ old('meta_keywords', $settings->meta_keywords) }}" placeholder="keyword1, keyword2, keyword3">
              @error('meta_keywords')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
              <label class="form-label">Meta Description</label>
              <textarea name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Brief description of your site">{{ old('meta_description', $settings->meta_description) }}</textarea>
              @error('meta_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
              </div>
            </div>

            <!-- Legal & Footer -->
            <div class="settings-section">
              <h5><i class="bi bi-file-text"></i>Legal & Footer</h5>
              <div class="row g-3">
            <div class="col-12">
              <label class="form-label">Footer Text</label>
              <input type="text" name="footer_text" class="form-control @error('footer_text') is-invalid @enderror" value="{{ old('footer_text', $settings->footer_text) }}" placeholder="Copyright text">
              @error('footer_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="form-label">Privacy Policy URL</label>
              <input type="text" name="privacy_url" class="form-control @error('privacy_url') is-invalid @enderror" value="{{ old('privacy_url', $settings->privacy_url) }}" placeholder="/privacy-policy">
              @error('privacy_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="form-label">Terms of Service URL</label>
              <input type="text" name="terms_url" class="form-control @error('terms_url') is-invalid @enderror" value="{{ old('terms_url', $settings->terms_url) }}" placeholder="/terms-of-service">
              @error('terms_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="form-label">Cookies Policy URL</label>
              <input type="text" name="cookies_url" class="form-control @error('cookies_url') is-invalid @enderror" value="{{ old('cookies_url', $settings->cookies_url) }}" placeholder="/cookies-policy">
              @error('cookies_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
              </div>
            </div>

            <!-- Customer Service Links -->
            <div class="settings-section">
              <h5><i class="bi bi-headset"></i>Customer Service Links</h5>
              <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Help Center URL</label>
              <input type="text" name="help_center_url" class="form-control @error('help_center_url') is-invalid @enderror" value="{{ old('help_center_url', $settings->help_center_url) }}" placeholder="/help-center">
              @error('help_center_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Shipping Info URL</label>
              <input type="text" name="shipping_info_url" class="form-control @error('shipping_info_url') is-invalid @enderror" value="{{ old('shipping_info_url', $settings->shipping_info_url) }}" placeholder="/shipping-info">
              @error('shipping_info_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Returns URL</label>
              <input type="text" name="returns_url" class="form-control @error('returns_url') is-invalid @enderror" value="{{ old('returns_url', $settings->returns_url) }}" placeholder="/returns">
              @error('returns_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Contact Us URL</label>
              <input type="text" name="contact_us_url" class="form-control @error('contact_us_url') is-invalid @enderror" value="{{ old('contact_us_url', $settings->contact_us_url) }}" placeholder="/contact-us">
              @error('contact_us_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
              </div>
            </div>

            <!-- Social Media Links -->
            <div class="settings-section">
              <h5><i class="bi bi-share"></i>Social Media Links</h5>
              <div class="row g-3">
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                <input type="text" name="social_facebook" class="form-control" placeholder="Facebook Page URL" value="{{ old('social_facebook', $settings->social_facebook) }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                <input type="text" name="social_twitter" class="form-control" placeholder="Twitter Profile URL" value="{{ old('social_twitter', $settings->social_twitter) }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                <input type="text" name="social_instagram" class="form-control" placeholder="Instagram Profile URL" value="{{ old('social_instagram', $settings->social_instagram) }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-linkedin"></i></span>
                <input type="text" name="social_linkedin" class="form-control" placeholder="LinkedIn Profile URL" value="{{ old('social_linkedin', $settings->social_linkedin) }}">
              </div>
            </div>
              </div>
            </div>
          </div>

          <!-- Features Tab -->
          <div class="tab-pane fade {{ $activeTab === 'features' ? 'show active' : '' }}" id="features" role="tabpanel" aria-labelledby="features-tab">
            <!-- Feature Toggles -->
            <div class="settings-section">
              <h5><i class="bi bi-toggle-on"></i>Feature Toggles</h5>
              
              <!-- Wishlist -->
              <div class="form-check-switch">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" name="wishlist_enabled" value="1" id="wishlist_enabled_switch" {{ old('wishlist_enabled', (int) ($settings->wishlist_enabled ?? 1)) ? 'checked' : '' }}>
                  <label class="form-check-label" for="wishlist_enabled_switch">
                    <strong>Enable Wishlist</strong>
                    <small>Show heart icon and allow users to save products to wishlist</small>
                  </label>
                </div>
              </div>

              <!-- Review Settings -->
              <div class="row g-3" id="review-settings">
                <div class="col-12">
                  <h6 class="mb-3 mt-3"><i class="bi bi-star me-1"></i>Review Settings</h6>
                </div>
                <div class="col-md-6">
                  <div class="form-check-switch">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" name="reviews_enabled" value="1" id="reviews_enabled_switch" {{ old('reviews_enabled', (int) ($settings->reviews_enabled ?? 1)) ? 'checked' : '' }}>
                      <label class="form-check-label" for="reviews_enabled_switch">
                        <strong>Enable Reviews</strong>
                        <small>Allow customers to leave product reviews</small>
                      </label>
                    </div>
                  </div>
                  <div class="form-check-switch">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" name="reviews_require_purchase" value="1" id="reviews_require_purchase_switch" {{ old('reviews_require_purchase', (int) ($settings->reviews_require_purchase ?? 0)) ? 'checked' : '' }}>
                      <label class="form-check-label" for="reviews_require_purchase_switch">
                        <strong>Require Purchase</strong>
                        <small>Only allow reviews from customers who purchased the product</small>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-check-switch">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" name="reviews_require_approval" value="1" id="reviews_require_approval_switch" {{ old('reviews_require_approval', (int) ($settings->reviews_require_approval ?? 1)) ? 'checked' : '' }}>
                      <label class="form-check-label" for="reviews_require_approval_switch">
                        <strong>Require Approval</strong>
                        <small>Reviews must be approved before being published</small>
                      </label>
                    </div>
                  </div>
                  <div class="form-check-switch">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" name="reviews_allow_anonymous" value="1" id="reviews_allow_anonymous_switch" {{ old('reviews_allow_anonymous', (int) ($settings->reviews_allow_anonymous ?? 0)) ? 'checked' : '' }}>
                      <label class="form-check-label" for="reviews_allow_anonymous_switch">
                        <strong>Allow Anonymous Reviews</strong>
                        <small>Allow non-logged-in users to submit reviews</small>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Newsletter Settings -->
              <div class="row g-3" id="newsletter-settings">
                <div class="col-12">
                  <h6 class="mb-3 mt-3"><i class="bi bi-envelope-paper me-1"></i>Newsletter Settings</h6>
                </div>
                <div class="col-md-4">
                  <div class="form-check-switch">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" name="newsletter_enabled" value="1" id="newsletter_enabled_switch" {{ old('newsletter_enabled', (int) ($settings->newsletter_enabled ?? 1)) ? 'checked' : '' }}>
                      <label class="form-check-label" for="newsletter_enabled_switch">
                        <strong>Enable Newsletter</strong>
                        <small>Allow users to subscribe to newsletter</small>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check-switch">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" name="newsletter_double_opt_in" value="1" id="newsletter_double_opt_in_switch" {{ old('newsletter_double_opt_in', (int) ($settings->newsletter_double_opt_in ?? 1)) ? 'checked' : '' }}>
                      <label class="form-check-label" for="newsletter_double_opt_in_switch">
                        <strong>Require Double Opt-in</strong>
                        <small>Require email confirmation for subscriptions</small>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check-switch">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" name="newsletter_send_welcome_email" value="1" id="newsletter_send_welcome_email_switch" {{ old('newsletter_send_welcome_email', (int) ($settings->newsletter_send_welcome_email ?? 1)) ? 'checked' : '' }}>
                      <label class="form-check-label" for="newsletter_send_welcome_email_switch">
                        <strong>Send Welcome Email</strong>
                        <small>Send welcome email to new subscribers</small>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Product Display Settings -->
            <div class="settings-section">
              <h5><i class="bi bi-grid"></i>Product Display Settings</h5>
              <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Products per Row (Mobile) <span class="text-danger">*</span></label>
              <select name="product_display_columns_mobile" class="form-select @error('product_display_columns_mobile') is-invalid @enderror" required>
                <option value="1" {{ old('product_display_columns_mobile', $settings->product_display_columns_mobile ?? 2) == 1 ? 'selected' : '' }}>1 Product</option>
                <option value="2" {{ old('product_display_columns_mobile', $settings->product_display_columns_mobile ?? 2) == 2 ? 'selected' : '' }}>2 Products</option>
                <option value="3" {{ old('product_display_columns_mobile', $settings->product_display_columns_mobile ?? 2) == 3 ? 'selected' : '' }}>3 Products</option>
              </select>
              <small class="text-muted">Number of products to display per row on mobile devices</small>
              @error('product_display_columns_mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Products per Row (Desktop) <span class="text-danger">*</span></label>
              <select name="product_display_columns_desktop" class="form-select @error('product_display_columns_desktop') is-invalid @enderror" required>
                <option value="2" {{ old('product_display_columns_desktop', $settings->product_display_columns_desktop ?? 3) == 2 ? 'selected' : '' }}>2 Products</option>
                <option value="3" {{ old('product_display_columns_desktop', $settings->product_display_columns_desktop ?? 3) == 3 ? 'selected' : '' }}>3 Products</option>
                <option value="4" {{ old('product_display_columns_desktop', $settings->product_display_columns_desktop ?? 3) == 4 ? 'selected' : '' }}>4 Products</option>
                <option value="5" {{ old('product_display_columns_desktop', $settings->product_display_columns_desktop ?? 3) == 5 ? 'selected' : '' }}>5 Products</option>
                <option value="6" {{ old('product_display_columns_desktop', $settings->product_display_columns_desktop ?? 3) == 6 ? 'selected' : '' }}>6 Products</option>
              </select>
              <small class="text-muted">Number of products to display per row on desktop/laptop screens</small>
              @error('product_display_columns_desktop')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
              </div>
            </div>
          </div>

          <!-- SEO & Sitemap Tab -->
          <div class="tab-pane fade {{ $activeTab === 'seo' ? 'show active' : '' }}" id="seo" role="tabpanel" aria-labelledby="seo-tab">
            <!-- Schema.org Settings -->
            <div class="settings-section">
              <h5><i class="bi bi-code-square"></i>Schema.org (Structured Data) Settings</h5>
              <div class="row g-3">
              <div class="form-check-switch mb-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" name="schema_enabled" value="1" id="schema_enabled_switch" {{ old('schema_enabled', (int) ($settings->schema_enabled ?? 1)) ? 'checked' : '' }}>
                  <label class="form-check-label" for="schema_enabled_switch">
                    <strong>Enable Schema.org Structured Data</strong>
                    <small>Adds structured data (JSON-LD) to pages for better SEO and rich snippets in search results</small>
                  </label>
                </div>
              </div>
            <div class="col-md-6">
              <label class="form-label">Organization Name</label>
              <input type="text" name="schema_organization_name" class="form-control" value="{{ old('schema_organization_name', $settings->schema_organization_name) }}" placeholder="{{ $settings->site_name }}">
              <small class="text-muted">Leave empty to use site name</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Organization Logo URL</label>
              <input type="text" name="schema_organization_logo" class="form-control" value="{{ old('schema_organization_logo', $settings->schema_organization_logo) }}" placeholder="https://example.com/logo.png">
              <small class="text-muted">Leave empty to use site logo</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Organization Phone</label>
              <input type="text" name="schema_organization_phone" class="form-control" value="{{ old('schema_organization_phone', $settings->schema_organization_phone) }}" placeholder="+1234567890">
            </div>
            <div class="col-md-6">
              <label class="form-label">Organization Email</label>
              <input type="email" name="schema_organization_email" class="form-control" value="{{ old('schema_organization_email', $settings->schema_organization_email) }}" placeholder="contact@example.com">
            </div>
            <div class="col-12">
              <label class="form-label">Organization Address</label>
              <textarea name="schema_organization_address" rows="2" class="form-control" placeholder="123 Main St, City, State, ZIP">{{ old('schema_organization_address', $settings->schema_organization_address) }}</textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">Organization Type</label>
              <select name="schema_organization_type" class="form-select">
                <option value="Store" {{ old('schema_organization_type', $settings->schema_organization_type ?? 'Store') == 'Store' ? 'selected' : '' }}>Store</option>
                <option value="LocalBusiness" {{ old('schema_organization_type', $settings->schema_organization_type ?? 'Store') == 'LocalBusiness' ? 'selected' : '' }}>Local Business</option>
                <option value="Organization" {{ old('schema_organization_type', $settings->schema_organization_type ?? 'Store') == 'Organization' ? 'selected' : '' }}>Organization</option>
                <option value="Corporation" {{ old('schema_organization_type', $settings->schema_organization_type ?? 'Store') == 'Corporation' ? 'selected' : '' }}>Corporation</option>
              </select>
            </div>
              </div>
            </div>

            <!-- Sitemap Settings -->
            <div class="settings-section">
              <h5><i class="bi bi-diagram-3"></i>Sitemap Settings</h5>
              <div class="row g-3">
              <div class="form-check-switch mb-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" name="sitemap_enabled" value="1" id="sitemap_enabled_switch" {{ old('sitemap_enabled', (int) ($settings->sitemap_enabled ?? 1)) ? 'checked' : '' }}>
                  <label class="form-check-label" for="sitemap_enabled_switch">
                    <strong>Enable Sitemap</strong>
                    <small>Generate sitemap.xml at <code>/sitemap.xml</code> for search engines</small>
                  </label>
                </div>
              </div>
            <div class="col-md-6">
              <label class="form-label">Homepage Priority (1-10)</label>
              <input type="number" name="sitemap_priority_home" class="form-control" min="1" max="10" value="{{ old('sitemap_priority_home', $settings->sitemap_priority_home ?? 10) }}" placeholder="10">
              <small class="text-muted">Default: 10 (highest priority)</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Product Priority (1-10)</label>
              <input type="number" name="sitemap_priority_product" class="form-control" min="1" max="10" value="{{ old('sitemap_priority_product', $settings->sitemap_priority_product ?? 8) }}" placeholder="8">
              <small class="text-muted">Default: 8</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Category Priority (1-10)</label>
              <input type="number" name="sitemap_priority_category" class="form-control" min="1" max="10" value="{{ old('sitemap_priority_category', $settings->sitemap_priority_category ?? 7) }}" placeholder="7">
              <small class="text-muted">Default: 7</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Page Priority (1-10)</label>
              <input type="number" name="sitemap_priority_page" class="form-control" min="1" max="10" value="{{ old('sitemap_priority_page', $settings->sitemap_priority_page ?? 6) }}" placeholder="6">
              <small class="text-muted">Default: 6</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Change Frequency</label>
              <select name="sitemap_change_frequency" class="form-select">
                <option value="always" {{ old('sitemap_change_frequency', $settings->sitemap_change_frequency ?? 'weekly') == 'always' ? 'selected' : '' }}>Always</option>
                <option value="hourly" {{ old('sitemap_change_frequency', $settings->sitemap_change_frequency ?? 'weekly') == 'hourly' ? 'selected' : '' }}>Hourly</option>
                <option value="daily" {{ old('sitemap_change_frequency', $settings->sitemap_change_frequency ?? 'weekly') == 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="weekly" {{ old('sitemap_change_frequency', $settings->sitemap_change_frequency ?? 'weekly') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ old('sitemap_change_frequency', $settings->sitemap_change_frequency ?? 'weekly') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                <option value="yearly" {{ old('sitemap_change_frequency', $settings->sitemap_change_frequency ?? 'weekly') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                <option value="never" {{ old('sitemap_change_frequency', $settings->sitemap_change_frequency ?? 'weekly') == 'never' ? 'selected' : '' }}>Never</option>
              </select>
              <small class="text-muted">How often content is updated</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Sitemap URL</label>
              <div class="input-group">
                <input type="text" class="form-control" value="{{ url('/sitemap.xml') }}" readonly>
                <a href="{{ url('/sitemap.xml') }}" target="_blank" class="btn btn-outline-secondary">
                  <i class="bi bi-box-arrow-up-right"></i> View
                </a>
              </div>
              <small class="text-muted">Submit this URL to Google Search Console and Bing Webmaster Tools</small>
            </div>
              </div>
            </div>
          </div>

          <!-- Theme Tab -->
          <div class="tab-pane fade {{ $activeTab === 'theme' ? 'show active' : '' }}" id="theme" role="tabpanel" aria-labelledby="theme-tab">
            <!-- Theme Selection -->
            @php
              $themeColumnExists = false;
              try {
                $themeColumnExists = \Schema::hasColumn('site_settings', 'theme');
              } catch (\Exception $e) {
                $themeColumnExists = false;
              }
              $currentTheme = 'theme1';
              if ($themeColumnExists) {
                try {
                  $currentTheme = $settings->theme ?? 'theme1';
                } catch (\Exception $e) {
                  $currentTheme = 'theme1';
                }
              }
            @endphp
            @if($themeColumnExists)
            <div class="settings-section">
              <h5><i class="bi bi-palette"></i>Theme Selection</h5>
              <div class="row g-3">
                <div class="col-md-12">
                  <label class="form-label">Active Theme <span class="text-danger">*</span></label>
                  <select name="theme" class="form-select @error('theme') is-invalid @enderror" required>
                    @foreach(\App\Support\ThemeHelper::available() as $key => $theme)
                      <option value="{{ $key }}" {{ old('theme', $currentTheme) == $key ? 'selected' : '' }}>
                        {{ $theme['name'] }} - {{ $theme['description'] }}
                      </option>
                    @endforeach
                  </select>
                  <small class="text-muted">Choose the active theme for your storefront. Changes will be visible immediately.</small>
                  @error('theme')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
              </div>
            </div>
            @else
            <div class="alert alert-info">
              <i class="bi bi-info-circle me-2"></i>
              <strong>Theme Selection:</strong> Run the migration to enable theme switching. 
              <code>php artisan migrate</code>
            </div>
            @endif

            <!-- License Key Section -->
            @php
              $licenseColumnExists = false;
              try {
                $licenseColumnExists = \Schema::hasColumn('site_settings', 'license_key');
              } catch (\Exception $e) {
                $licenseColumnExists = false;
              }
              $licenseInfo = [];
              if ($licenseColumnExists) {
                try {
                  $licenseInfo = \App\Support\LicenseHelper::getLicenseInfo();
                } catch (\Exception $e) {
                  $licenseInfo = ['is_valid' => false, 'key' => null];
                }
              }
            @endphp
            @if($licenseColumnExists)
            <div class="settings-section">
              <h5><i class="bi bi-key"></i>License Key</h5>
              <div class="row g-3">
                <div class="col-md-12">
                  <label class="form-label">License Key</label>
                  <div class="input-group">
                    <input 
                      type="text" 
                      name="license_key" 
                      class="form-control @error('license_key') is-invalid @enderror" 
                      value="{{ old('license_key', $settings->license_key ?? '') }}" 
                      placeholder="Enter your license key"
                    >
                    <button type="button" class="btn btn-outline-secondary" onclick="checkLicense()" id="checkLicenseBtn">
                      <i class="bi bi-check-circle me-1"></i>Validate
                    </button>
                  </div>
                  <small class="text-muted">
                    Enter your license key to activate the application. 
                    <a href="{{ route('admin.license.activate') }}" class="text-decoration-none">Go to License Activation Page</a>
                  </small>
                  @error('license_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  
                  @if($licenseInfo['key'] || $settings->license_key ?? null)
                    <div class="mt-3">
                      <div class="d-flex align-items-center gap-3 mb-2">
                        <strong>Status:</strong>
                        @if($licenseInfo['is_valid'] ?? false)
                          <span class="badge bg-success">
                            <i class="bi bi-check-circle me-1"></i>Active
                          </span>
                        @else
                          <span class="badge bg-warning">
                            <i class="bi bi-exclamation-triangle me-1"></i>Not Validated
                          </span>
                        @endif
                      </div>
                      @if($licenseInfo['last_validation'] ?? null)
                        <small class="text-muted d-block mb-2">Last validated: {{ $licenseInfo['last_validation']->format('d M Y, h:i A') }}</small>
                      @endif
                      <button 
                        type="button" 
                        class="btn btn-danger btn-sm" 
                        onclick="removeLicense()" 
                        id="removeLicenseBtn"
                        title="Remove active license key"
                      >
                        <i class="bi bi-trash me-1"></i>Remove License
                      </button>
                      <small class="text-muted d-block mt-2">
                        <i class="bi bi-info-circle me-1"></i>
                        Removing the license will block access to the application until a new license is activated.
                      </small>
                    </div>
                  @endif
                </div>
              </div>
            </div>
            @else
            <div class="alert alert-info">
              <i class="bi bi-info-circle me-2"></i>
              <strong>License Key:</strong> Run the migration to enable license key management. 
              <code>php artisan migrate</code>
            </div>
            @endif
          </div>

          <!-- Tracking Codes Tab -->
          <div class="tab-pane fade {{ $activeTab === 'tracking' ? 'show active' : '' }}" id="tracking" role="tabpanel" aria-labelledby="tracking-tab">
            <!-- Google Analytics -->
            <div class="settings-section">
              <h5><i class="bi bi-google"></i>Google Analytics</h5>
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Google Analytics Code (gtag.js or analytics.js)</label>
                  <textarea name="google_analytics_code" rows="6" class="form-control font-monospace small" placeholder="Paste your Google Analytics tracking code here (gtag.js or analytics.js)">{{ old('google_analytics_code', $settings->google_analytics_code) }}</textarea>
                  <small class="text-muted">Paste your complete Google Analytics tracking code here. It will be added to the &lt;head&gt; section.</small>
                </div>
              </div>
            </div>

            <!-- Facebook Pixel -->
            <div class="settings-section">
              <h5><i class="bi bi-facebook"></i>Facebook Pixel</h5>
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Facebook Pixel Code</label>
                  <textarea name="facebook_pixel_code" rows="6" class="form-control font-monospace small" placeholder="Paste your Facebook Pixel tracking code here">{{ old('facebook_pixel_code', $settings->facebook_pixel_code) }}</textarea>
                  <small class="text-muted">Paste your complete Facebook Pixel code here. It will be added to the &lt;head&gt; section.</small>
                </div>
              </div>
            </div>

            <!-- Microsoft Clarity -->
            <div class="settings-section">
              <h5><i class="bi bi-microsoft"></i>Microsoft Clarity</h5>
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Microsoft Clarity Code</label>
                  <textarea name="microsoft_clarity_code" rows="6" class="form-control font-monospace small" placeholder="Paste your Microsoft Clarity tracking code here">{{ old('microsoft_clarity_code', $settings->microsoft_clarity_code) }}</textarea>
                  <small class="text-muted">Paste your complete Microsoft Clarity tracking code here. It will be added to the &lt;head&gt; section.</small>
                </div>
              </div>
            </div>

            <!-- Custom Head Code -->
            <div class="settings-section">
              <h5><i class="bi bi-code-slash"></i>Custom Head Code</h5>
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Custom Code for &lt;head&gt; Section</label>
                  <textarea name="custom_head_code" rows="6" class="form-control font-monospace small" placeholder="Add any custom tracking codes, meta tags, or scripts for the &lt;head&gt; section">{{ old('custom_head_code', $settings->custom_head_code) }}</textarea>
                  <small class="text-muted">Add any custom tracking codes, meta tags, or scripts that should be placed in the &lt;head&gt; section.</small>
                </div>
              </div>
            </div>

            <!-- Custom Body Code -->
            <div class="settings-section">
              <h5><i class="bi bi-code-square"></i>Custom Body Code</h5>
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Custom Code for &lt;body&gt; Section (Before closing tag)</label>
                  <textarea name="custom_body_code" rows="6" class="form-control font-monospace small" placeholder="Add any custom tracking codes or scripts for the &lt;body&gt; section (before closing tag)">{{ old('custom_body_code', $settings->custom_body_code) }}</textarea>
                  <small class="text-muted">Add any custom tracking codes or scripts that should be placed before the closing &lt;/body&gt; tag.</small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Save Button -->
        <div class="card-footer bg-white border-top p-3">
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-lg">
              <i class="bi bi-save me-2"></i>Save All Settings
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var activeTabInput = document.getElementById('activeTabInput');
    var tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
    tabButtons.forEach(function(btn) {
      btn.addEventListener('shown.bs.tab', function() {
        var target = this.getAttribute('data-bs-target');
        if (target && target.charAt(0) === '#' && activeTabInput) {
          activeTabInput.value = target.slice(1);
        }
        if (window.innerWidth < 768) {
          var tabContent = document.getElementById('settingsTabContent');
          if (tabContent) tabContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
  });

  // License validation function
  function checkLicense() {
    const btn = document.getElementById('checkLicenseBtn');
    const licenseKey = document.querySelector('input[name="license_key"]').value;
    
    if (!licenseKey) {
      Swal.fire({
        icon: 'warning',
        title: 'License Key Required',
        text: 'Please enter a license key first',
        confirmButtonColor: '#667eea'
      });
      return;
    }

    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Validating...';

    fetch('{{ route("admin.license.check") }}', {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
      }
    })
    .then(response => response.json())
    .then(data => {
      btn.disabled = false;
      btn.innerHTML = '<i class="bi bi-check-circle me-1"></i>Validate';
      
      if (data.valid) {
        Swal.fire({
          icon: 'success',
          title: 'License Valid!',
          text: 'Your license key is valid and active.',
          confirmButtonColor: '#667eea',
          timer: 2000,
          timerProgressBar: true,
          showConfirmButton: false
        }).then(() => {
          location.reload();
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'License Invalid',
          text: 'License validation failed. Please check your license key.',
          confirmButtonColor: '#667eea'
        });
      }
    })
    .catch(error => {
      btn.disabled = false;
      btn.innerHTML = '<i class="bi bi-check-circle me-1"></i>Validate';
      Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Error validating license. Please try again.',
        confirmButtonColor: '#667eea'
      });
      console.error('License validation error:', error);
    });
  }

  // Remove license function
  function removeLicense() {
    Swal.fire({
      icon: 'warning',
      title: 'Remove License?',
      text: 'This will block access to the application until a new license is activated.',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, Remove It',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (!result.isConfirmed) {
        return;
      }

      const btn = document.getElementById('removeLicenseBtn');
      const originalText = btn.innerHTML;
      
      btn.disabled = true;
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Removing...';

      fetch('{{ route("admin.license.remove") }}', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(response => response.json())
      .then(data => {
        btn.disabled = false;
        btn.innerHTML = originalText;
        
        if (data.success) {
          Swal.fire({
            icon: 'success',
            title: 'License Removed',
            text: data.message || 'License key removed successfully!',
            confirmButtonColor: '#667eea',
            timer: 2000,
            timerProgressBar: true
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Removal Failed',
            text: data.message || 'Failed to remove license key. Please try again.',
            confirmButtonColor: '#667eea'
          });
        }
      })
      .catch(error => {
        btn.disabled = false;
        btn.innerHTML = originalText;
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Error removing license. Please try again.',
          confirmButtonColor: '#667eea'
        });
        console.error('License removal error:', error);
      });
    });
  }
</script>
@endpush
