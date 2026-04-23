<?php

namespace App\Support;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductReview;
use App\Models\SiteSetting;

class SchemaOrgHelper
{
    protected $siteSettings;
    protected $baseUrl;

    public function __construct()
    {
        $this->siteSettings = SiteSetting::get();
        $this->baseUrl = url('/');
    }

    /**
     * Generate Organization schema
     */
    public function organization(): array
    {
        if (!$this->siteSettings->schema_enabled) {
            return [];
        }

        $organization = [
            '@context' => 'https://schema.org',
            '@type' => $this->siteSettings->schema_organization_type ?? 'Store',
            'name' => $this->siteSettings->schema_organization_name ?? $this->siteSettings->site_name,
            'url' => $this->baseUrl,
        ];

        if ($this->siteSettings->logo_url) {
            $organization['logo'] = $this->siteSettings->logo_url;
        }

        if ($this->siteSettings->schema_organization_logo) {
            $organization['logo'] = $this->siteSettings->schema_organization_logo;
        }

        if ($this->siteSettings->schema_organization_phone) {
            $organization['telephone'] = $this->siteSettings->schema_organization_phone;
        }

        if ($this->siteSettings->schema_organization_email) {
            $organization['email'] = $this->siteSettings->schema_organization_email;
        }

        if ($this->siteSettings->schema_organization_address) {
            $organization['address'] = [
                '@type' => 'PostalAddress',
                'streetAddress' => $this->siteSettings->schema_organization_address,
            ];
        }

        // Social media
        $sameAs = [];
        if ($this->siteSettings->social_facebook) {
            $sameAs[] = $this->siteSettings->social_facebook;
        }
        if ($this->siteSettings->social_twitter) {
            $sameAs[] = $this->siteSettings->social_twitter;
        }
        if ($this->siteSettings->social_instagram) {
            $sameAs[] = $this->siteSettings->social_instagram;
        }
        if ($this->siteSettings->social_linkedin) {
            $sameAs[] = $this->siteSettings->social_linkedin;
        }
        if (!empty($sameAs)) {
            $organization['sameAs'] = $sameAs;
        }

        return $organization;
    }

    /**
     * Generate WebSite schema
     */
    public function website(): array
    {
        if (!$this->siteSettings->schema_enabled) {
            return [];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $this->siteSettings->site_name,
            'url' => $this->baseUrl,
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $this->baseUrl . '/products?q={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * Generate Product schema
     */
    public function product(Product $product): array
    {
        if (!$this->siteSettings->schema_enabled) {
            return [];
        }

        $productUrl = route('products.show', $product->slug);
        $primaryImage = $product->images->where('is_primary', true)->first() 
            ?? $product->images->first();
        $imageUrl = $primaryImage 
            ? asset('storage/' . $primaryImage->path) 
            : null;

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => strip_tags($product->short_description ?? $product->description ?? ''),
            'sku' => $product->sku,
            'url' => $productUrl,
        ];

        if ($imageUrl) {
            $schema['image'] = $imageUrl;
        }

        // Get currency
        $currency = \App\Support\CurrencyManager::current();
        $currencyCode = $currency ? $currency->code : 'BDT';
        
        // Offer
        $offer = [
            '@type' => 'Offer',
            'price' => number_format($product->price, 2, '.', ''),
            'priceCurrency' => $currencyCode,
            'availability' => $product->stock > 0 
                ? 'https://schema.org/InStock' 
                : 'https://schema.org/OutOfStock',
            'url' => $productUrl,
        ];

        if ($product->compare_at_price && $product->price < $product->compare_at_price) {
            $offer['priceValidUntil'] = now()->addYear()->format('Y-m-d');
        }

        $schema['offers'] = $offer;

        // Brand
        if ($product->category) {
            $schema['brand'] = [
                '@type' => 'Brand',
                'name' => $product->category->name,
            ];
        }

        // Category
        if ($product->category) {
            $schema['category'] = $product->category->name;
        }

        // Aggregate Rating & Reviews
        $reviews = $product->approvedReviews()->with('user')->get();
        if ($reviews->count() > 0) {
            $ratings = $reviews->pluck('rating')->filter();
            if ($ratings->count() > 0) {
                $avgRating = $ratings->avg();
                $schema['aggregateRating'] = [
                    '@type' => 'AggregateRating',
                    'ratingValue' => round($avgRating, 1),
                    'reviewCount' => $reviews->count(),
                    'bestRating' => 5,
                    'worstRating' => 1,
                ];

                // Individual reviews
                $reviewSchemas = [];
                foreach ($reviews->take(10) as $review) {
                    $reviewSchema = [
                        '@type' => 'Review',
                        'author' => [
                            '@type' => 'Person',
                            'name' => $review->user ? $review->user->name : 'Anonymous',
                        ],
                        'datePublished' => $review->created_at->format('Y-m-d'),
                        'reviewBody' => strip_tags($review->comment ?? ''),
                        'reviewRating' => [
                            '@type' => 'Rating',
                            'ratingValue' => $review->rating,
                            'bestRating' => 5,
                            'worstRating' => 1,
                        ],
                    ];
                    $reviewSchemas[] = $reviewSchema;
                }
                if (!empty($reviewSchemas)) {
                    $schema['review'] = $reviewSchemas;
                }
            }
        }

        return $schema;
    }

    /**
     * Generate BreadcrumbList schema
     */
    public function breadcrumbs(array $items): array
    {
        if (!$this->siteSettings->schema_enabled || empty($items)) {
            return [];
        }

        $breadcrumbList = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [],
        ];

        $position = 1;
        foreach ($items as $item) {
            $breadcrumbList['itemListElement'][] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $item['name'],
                'item' => $item['url'] ?? $this->baseUrl,
            ];
        }

        return $breadcrumbList;
    }

    /**
     * Generate CollectionPage schema for category
     */
    public function collectionPage(Category $category): array
    {
        if (!$this->siteSettings->schema_enabled) {
            return [];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => $category->name,
            'description' => strip_tags($category->description ?? ''),
            'url' => route('categories.show', $category->slug),
        ];
    }
}

