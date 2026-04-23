<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::get();
        
        if (!$settings->sitemap_enabled) {
            abort(404);
        }

        $baseUrl = url('/');
        $changeFreq = $settings->sitemap_change_frequency ?? 'weekly';
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Homepage
        $xml .= $this->urlElement(
            $baseUrl,
            $settings->sitemap_priority_home / 10,
            $changeFreq,
            now()
        );

        // Products
        $products = Product::where('is_active', true)->get();
        foreach ($products as $product) {
            $xml .= $this->urlElement(
                route('products.show', $product->slug),
                $settings->sitemap_priority_product / 10,
                $changeFreq,
                $product->updated_at
            );
        }

        // Categories
        $categories = Category::where('is_active', true)->get();
        foreach ($categories as $category) {
            $xml .= $this->urlElement(
                route('categories.show', $category->slug),
                $settings->sitemap_priority_category / 10,
                $changeFreq,
                $category->updated_at
            );
        }

        // Pages
        $pages = Page::where('is_active', true)->get();
        foreach ($pages as $page) {
            $xml .= $this->urlElement(
                route('pages.show', $page->slug),
                $settings->sitemap_priority_page / 10,
                $changeFreq,
                $page->updated_at
            );
        }

        $xml .= '</urlset>';

        return Response::make($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }

    protected function urlElement(string $url, float $priority, string $changeFreq, $lastMod): string
    {
        $xml = "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($url, ENT_XML1, 'UTF-8') . "</loc>\n";
        $xml .= "    <priority>" . number_format($priority, 1, '.', '') . "</priority>\n";
        $xml .= "    <changefreq>" . htmlspecialchars($changeFreq, ENT_XML1, 'UTF-8') . "</changefreq>\n";
        $xml .= "    <lastmod>" . $lastMod->format('Y-m-d') . "</lastmod>\n";
        $xml .= "  </url>\n";
        return $xml;
    }
}
