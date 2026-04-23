<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name','site_tagline','logo_url','favicon_url','meta_title','meta_description','meta_keywords',
        'footer_text','privacy_url','terms_url','cookies_url','help_center_url','shipping_info_url','returns_url','contact_us_url',
        'wishlist_enabled','social_facebook','social_twitter','social_instagram','social_linkedin',
        'reviews_enabled','reviews_require_purchase','reviews_require_approval','reviews_allow_anonymous',
        'newsletter_enabled','newsletter_double_opt_in','newsletter_send_welcome_email',
        'product_display_columns_mobile','product_display_columns_desktop',
        'schema_enabled','schema_organization_name','schema_organization_logo','schema_organization_phone',
        'schema_organization_email','schema_organization_address','schema_organization_type',
        'sitemap_enabled','sitemap_priority_home','sitemap_priority_product','sitemap_priority_category',
        'sitemap_priority_page','sitemap_change_frequency',
        'google_analytics_code','facebook_pixel_code','microsoft_clarity_code','custom_head_code','custom_body_code',
        'installer_enabled','theme','license_key'
    ];

    protected $casts = [
        'wishlist_enabled' => 'boolean',
        'reviews_enabled' => 'boolean',
        'reviews_require_purchase' => 'boolean',
        'reviews_require_approval' => 'boolean',
        'reviews_allow_anonymous' => 'boolean',
        'newsletter_enabled' => 'boolean',
        'newsletter_double_opt_in' => 'boolean',
        'newsletter_send_welcome_email' => 'boolean',
        'schema_enabled' => 'boolean',
        'sitemap_enabled' => 'boolean',
        'installer_enabled' => 'boolean',
    ];

    public static function get(): self
    {
        return static::first() ?? static::create([]);
    }
}


