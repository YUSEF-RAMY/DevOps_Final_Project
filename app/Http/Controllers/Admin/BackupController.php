<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BackupController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        
        return view('admin.backup.index', compact('productsCount', 'categoriesCount'));
    }

    /**
     * Export single product
     */
    public function exportProduct(Product $product)
    {
        try {
            $productData = $this->prepareProductData($product);
            
            $filename = 'product_' . Str::slug($product->name) . '_' . date('Y-m-d_His') . '.json';
            
            return response()->json($productData, 200, [
                'Content-Type' => 'application/json',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        } catch (\Exception $e) {
            Log::error('Product export failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to export product: ' . $e->getMessage());
        }
    }

    /**
     * Export all products
     */
    public function exportAll(Request $request)
    {
        try {
            $format = $request->get('format', 'json'); // json or csv
            
            if ($format === 'csv') {
                return $this->exportAllCsv();
            }
            
            return $this->exportAllJson();
        } catch (\Exception $e) {
            Log::error('Products export failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to export products: ' . $e->getMessage());
        }
    }

    /**
     * Export all products as JSON
     */
    private function exportAllJson()
    {
        $products = Product::with(['category', 'images'])->get();
        
        $exportData = [
            'version' => '1.0',
            'export_date' => now()->toIso8601String(),
            'total_products' => $products->count(),
            'products' => $products->map(function ($product) {
                return $this->prepareProductData($product);
            })->toArray(),
        ];
        
        $filename = 'products_backup_' . date('Y-m-d_His') . '.json';
        
        return response()->json($exportData, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Export all products as CSV
     */
    private function exportAllCsv()
    {
        $products = Product::with(['category', 'images'])->get();
        
        $filename = 'products_backup_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($products) {
            $file = fopen('php://output', 'w');
            
            // CSV Headers
            fputcsv($file, [
                'ID', 'Name', 'Slug', 'SKU', 'Category', 'Short Description', 'Description',
                'Price', 'Compare At Price', 'Stock', 'Active', 'Featured',
                'Meta Title', 'Meta Description', 'Created At', 'Updated At'
            ]);
            
            // Product Data
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->slug,
                    $product->sku ?? '',
                    $product->category->name ?? '',
                    strip_tags($product->short_description ?? ''),
                    strip_tags($product->description ?? ''),
                    $product->price,
                    $product->compare_at_price ?? '',
                    $product->stock,
                    $product->is_active ? 'Yes' : 'No',
                    $product->is_featured ? 'Yes' : 'No',
                    $product->meta_title ?? '',
                    $product->meta_description ?? '',
                    $product->created_at,
                    $product->updated_at,
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Prepare product data for export
     */
    private function prepareProductData(Product $product)
    {
        $product->load(['category', 'images']);
        
        return [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'sku' => $product->sku,
            'category_id' => $product->category_id,
            'category_name' => $product->category->name ?? null,
            'short_description' => $product->short_description,
            'description' => $product->description,
            'price' => $product->price,
            'compare_at_price' => $product->compare_at_price,
            'stock' => $product->stock,
            'is_active' => $product->is_active,
            'is_featured' => $product->is_featured,
            'meta_title' => $product->meta_title,
            'meta_description' => $product->meta_description,
            'images' => $product->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'url' => $image->url,
                    'alt' => $image->alt,
                    'is_primary' => $image->is_primary,
                    'position' => $image->position,
                ];
            })->toArray(),
            'created_at' => $product->created_at->toIso8601String(),
            'updated_at' => $product->updated_at->toIso8601String(),
        ];
    }

    /**
     * Show import form
     */
    public function import()
    {
        return view('admin.backup.import');
    }

    /**
     * Process import
     */
    public function processImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:json,csv,txt|max:10240', // 10MB max
            'import_mode' => 'required|in:create,update,replace',
        ]);

        try {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $importMode = $request->input('import_mode');
            
            if ($extension === 'json') {
                return $this->importJson($file, $importMode);
            } elseif ($extension === 'csv') {
                return $this->importCsv($file, $importMode);
            }
            
            return back()->with('error', 'Unsupported file format. Please use JSON or CSV.');
        } catch (\Exception $e) {
            Log::error('Import failed: ' . $e->getMessage());
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Import JSON file
     */
    private function importJson($file, $importMode)
    {
        $content = file_get_contents($file->getRealPath());
        $data = json_decode($content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->with('error', 'Invalid JSON file: ' . json_last_error_msg());
        }
        
        // Handle single product or multiple products
        if (isset($data['products'])) {
            $products = $data['products'];
        } elseif (isset($data['id'])) {
            $products = [$data];
        } else {
            return back()->with('error', 'Invalid JSON structure. Expected products array or single product object.');
        }
        
        return $this->importProducts($products, $importMode);
    }

    /**
     * Import CSV file
     */
    private function importCsv($file, $importMode)
    {
        $handle = fopen($file->getRealPath(), 'r');
        $headers = fgetcsv($handle); // Skip header row
        
        if (!$headers) {
            return back()->with('error', 'Invalid CSV file format.');
        }
        
        $products = [];
        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < count($headers)) {
                continue; // Skip invalid rows
            }
            
            $product = array_combine($headers, $row);
            $products[] = [
                'id' => $product['ID'] ?? null,
                'name' => $product['Name'] ?? '',
                'slug' => $product['Slug'] ?? Str::slug($product['Name'] ?? ''),
                'sku' => $product['SKU'] ?? null,
                'category_name' => $product['Category'] ?? '',
                'short_description' => $product['Short Description'] ?? '',
                'description' => $product['Description'] ?? '',
                'price' => $product['Price'] ?? 0,
                'compare_at_price' => $product['Compare At Price'] ?? null,
                'stock' => $product['Stock'] ?? 0,
                'is_active' => ($product['Active'] ?? 'No') === 'Yes',
                'is_featured' => ($product['Featured'] ?? 'No') === 'Yes',
                'meta_title' => $product['Meta Title'] ?? null,
                'meta_description' => $product['Meta Description'] ?? null,
            ];
        }
        fclose($handle);
        
        return $this->importProducts($products, $importMode);
    }

    /**
     * Import products into database
     */
    private function importProducts(array $products, $importMode)
    {
        DB::beginTransaction();
        
        try {
            $imported = 0;
            $updated = 0;
            $skipped = 0;
            $errors = [];
            
            foreach ($products as $index => $productData) {
                try {
                    // Find or create category if category_name is provided
                    $categoryId = null;
                    if (!empty($productData['category_name'])) {
                        $category = Category::firstOrCreate(
                            ['name' => $productData['category_name']],
                            ['slug' => Str::slug($productData['category_name']), 'is_active' => true]
                        );
                        $categoryId = $category->id;
                    } elseif (!empty($productData['category_id'])) {
                        // Verify category exists
                        $category = Category::find($productData['category_id']);
                        if ($category) {
                            $categoryId = $category->id;
                        }
                    }
                    
                    $productData['category_id'] = $categoryId;
                    
                    // Prepare product attributes
                    $attributes = [
                        'name' => $productData['name'] ?? '',
                        'slug' => $productData['slug'] ?? Str::slug($productData['name'] ?? ''),
                        'sku' => $productData['sku'] ?? null,
                        'category_id' => $categoryId,
                        'short_description' => $productData['short_description'] ?? '',
                        'description' => $productData['description'] ?? '',
                        'price' => $productData['price'] ?? 0,
                        'compare_at_price' => $productData['compare_at_price'] ?? null,
                        'stock' => $productData['stock'] ?? 0,
                        'is_active' => $productData['is_active'] ?? true,
                        'is_featured' => $productData['is_featured'] ?? false,
                        'meta_title' => $productData['meta_title'] ?? null,
                        'meta_description' => $productData['meta_description'] ?? null,
                    ];
                    
                    // Handle import mode
                    if ($importMode === 'replace' && !empty($productData['id'])) {
                        // Replace: Delete existing and create new
                        Product::where('id', $productData['id'])->delete();
                        $product = Product::create($attributes);
                        $imported++;
                    } elseif ($importMode === 'update' && !empty($productData['id'])) {
                        // Update: Update existing or create if not exists
                        $product = Product::updateOrCreate(
                            ['id' => $productData['id']],
                            $attributes
                        );
                        if ($product->wasRecentlyCreated) {
                            $imported++;
                        } else {
                            $updated++;
                        }
                    } else {
                        // Create: Only create new products
                        // Check if product exists by slug or SKU
                        $existing = Product::where('slug', $attributes['slug'])
                            ->orWhere(function($q) use ($attributes) {
                                if ($attributes['sku']) {
                                    $q->where('sku', $attributes['sku']);
                                }
                            })
                            ->first();
                        
                        if ($existing) {
                            $skipped++;
                            continue;
                        }
                        
                        $product = Product::create($attributes);
                        $imported++;
                    }
                    
                    // Import images if provided
                    if (isset($productData['images']) && is_array($productData['images'])) {
                        foreach ($productData['images'] as $imageData) {
                            ProductImage::updateOrCreate(
                                [
                                    'product_id' => $product->id,
                                    'url' => $imageData['url'] ?? '',
                                ],
                                [
                                    'alt' => $imageData['alt'] ?? '',
                                    'is_primary' => $imageData['is_primary'] ?? false,
                                    'position' => $imageData['position'] ?? 0,
                                ]
                            );
                        }
                    }
                } catch (\Exception $e) {
                    $errors[] = "Row " . ($index + 1) . ": " . $e->getMessage();
                    $skipped++;
                }
            }
            
            DB::commit();
            
            $message = "Import completed! Imported: {$imported}, Updated: {$updated}, Skipped: {$skipped}";
            if (!empty($errors)) {
                $message .= ". Errors: " . count($errors);
            }
            
            return back()->with('success', $message)->with('import_details', [
                'imported' => $imported,
                'updated' => $updated,
                'skipped' => $skipped,
                'errors' => $errors,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Import transaction failed: ' . $e->getMessage());
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Show WordPress import form
     */
    public function importWordPress()
    {
        return view('admin.backup.import-wordpress');
    }

    /**
     * Process WordPress import
     */
    public function processWordPressImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xml,txt|max:10240', // 10MB max
            'import_mode' => 'required|in:create,update,replace',
        ]);

        try {
            $file = $request->file('file');
            $importMode = $request->input('import_mode');
            
            return $this->importWordPressXml($file, $importMode);
        } catch (\Exception $e) {
            Log::error('WordPress import failed: ' . $e->getMessage());
            return back()->with('error', 'WordPress import failed: ' . $e->getMessage());
        }
    }

    /**
     * Import WordPress XML/WXR file
     */
    private function importWordPressXml($file, $importMode)
    {
        $content = file_get_contents($file->getRealPath());
        
        // Parse XML
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($content);
        
        if ($xml === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            return back()->with('error', 'Invalid XML file: ' . ($errors[0]->message ?? 'Unknown error'));
        }
        
        // Register namespaces
        $xml->registerXPathNamespace('wp', 'http://wordpress.org/export/1.2/');
        $xml->registerXPathNamespace('content', 'http://purl.org/rss/1.0/modules/content/');
        
        $products = [];
        
        // WordPress/WooCommerce products are in <item> tags with post_type="product"
        if (!isset($xml->channel->item)) {
            return back()->with('error', 'No items found in WordPress export file.');
        }
        
        foreach ($xml->channel->item as $item) {
            // Register namespaces for this item
            $namespaces = $item->getNamespaces(true);
            $wp = $item->children($namespaces['wp'] ?? 'http://wordpress.org/export/1.2/');
            $content = $item->children($namespaces['content'] ?? 'http://purl.org/rss/1.0/modules/content/');
            
            $postType = (string) ($wp->post_type ?? '');
            
            if ($postType !== 'product') {
                continue; // Skip non-product items
            }
            
            // Extract product data
            $title = (string) $item->title;
            $description = (string) ($item->description ?? '');
            $link = (string) ($item->link ?? '');
            
            // Extract custom fields (WooCommerce product data)
            $meta = [];
            if (isset($wp->postmeta)) {
                foreach ($wp->postmeta as $postmeta) {
                    $key = (string) ($postmeta->meta_key ?? '');
                    $value = (string) ($postmeta->meta_value ?? '');
                    if (!empty($key)) {
                        $meta[$key] = $value;
                    }
                }
            }
            
            // Extract categories
            $categories = [];
            if (isset($item->category)) {
                foreach ($item->category as $cat) {
                    $catName = (string) $cat;
                    if (!empty($catName)) {
                        $categories[] = $catName;
                    }
                }
            }
            
            // Extract images from content
            $images = [];
            $contentEncoded = (string) ($content->encoded ?? '');
            if (!empty($contentEncoded)) {
                // Extract image URLs from content
                preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/', $contentEncoded, $matches);
                if (!empty($matches[1])) {
                    $images = array_slice($matches[1], 0, 5); // Limit to 5 images
                }
            }
            
            // Also check for featured image in meta
            if (isset($meta['_thumbnail_id']) && !empty($meta['_thumbnail_id'])) {
                // Try to find the image URL from attachment
                // This is a simplified approach - in a full implementation, you'd parse attachment items
            }
            
            // Map WooCommerce fields
            $price = 0;
            if (isset($meta['_regular_price']) && !empty($meta['_regular_price'])) {
                $price = (float) $meta['_regular_price'];
            } elseif (isset($meta['_price']) && !empty($meta['_price'])) {
                $price = (float) $meta['_price'];
            }
            
            $compareAtPrice = null;
            if (isset($meta['_sale_price']) && !empty($meta['_sale_price'])) {
                $compareAtPrice = (float) $meta['_sale_price'];
            }
            
            $stock = 0;
            if (isset($meta['_stock']) && is_numeric($meta['_stock'])) {
                $stock = (int) $meta['_stock'];
            } elseif (isset($meta['_manage_stock']) && $meta['_manage_stock'] === 'yes') {
                $stock = 0; // Managed stock but no quantity set
            } else {
                $stock = 100; // Default stock
            }
            
            $product = [
                'name' => $title,
                'slug' => Str::slug($title),
                'sku' => $meta['_sku'] ?? null,
                'category_name' => !empty($categories) ? $categories[0] : 'Uncategorized',
                'short_description' => strip_tags($description),
                'description' => strip_tags($description),
                'price' => $price,
                'compare_at_price' => $compareAtPrice,
                'stock' => $stock,
                'is_active' => ($meta['_visibility'] ?? 'visible') !== 'hidden',
                'is_featured' => ($meta['_featured'] ?? 'no') === 'yes',
                'images' => array_map(function($url, $index) {
                    return [
                        'url' => $url, 
                        'alt' => '', 
                        'is_primary' => $index === 0, 
                        'position' => $index
                    ];
                }, array_values($images), array_keys($images)),
            ];
            
            $products[] = $product;
        }
        
        if (empty($products)) {
            return back()->with('error', 'No products found in WordPress export file. Make sure you exported products from WooCommerce.');
        }
        
        return $this->importProducts($products, $importMode);
    }

    /**
     * Show Shopify import form
     */
    public function importShopify()
    {
        return view('admin.backup.import-shopify');
    }

    /**
     * Process Shopify import
     */
    public function processShopifyImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:10240', // 10MB max
            'import_mode' => 'required|in:create,update,replace',
        ]);

        try {
            $file = $request->file('file');
            $importMode = $request->input('import_mode');
            
            return $this->importShopifyCsv($file, $importMode);
        } catch (\Exception $e) {
            Log::error('Shopify import failed: ' . $e->getMessage());
            return back()->with('error', 'Shopify import failed: ' . $e->getMessage());
        }
    }

    /**
     * Import Shopify CSV file
     */
    private function importShopifyCsv($file, $importMode)
    {
        $handle = fopen($file->getRealPath(), 'r');
        if (!$handle) {
            return back()->with('error', 'Could not read Shopify CSV file.');
        }
        
        // Read header row
        $headers = fgetcsv($handle);
        if (!$headers) {
            fclose($handle);
            return back()->with('error', 'Invalid Shopify CSV file format.');
        }
        
        // Normalize headers (lowercase, trim)
        $headers = array_map(function($h) {
            return strtolower(trim($h));
        }, $headers);
        
        $products = [];
        $rowIndex = 1;
        
        while (($row = fgetcsv($handle)) !== false) {
            $rowIndex++;
            
            if (count($row) < count($headers)) {
                // Pad row with empty strings if needed
                $row = array_pad($row, count($headers), '');
            }
            
            $data = array_combine($headers, $row);
            if ($data === false) {
                continue; // Skip invalid rows
            }
            
            // Map Shopify CSV columns to our product structure
            // Shopify CSV typically has: Handle, Title, Body (HTML), Vendor, Type, Tags, Published, Variant SKU, Variant Price, etc.
            $productHandle = $data['handle'] ?? '';
            $title = $data['title'] ?? '';
            
            // Skip empty rows
            if (empty($title)) {
                continue;
            }
            
            $body = $data['body (html)'] ?? $data['body'] ?? $data['body html'] ?? '';
            $vendor = $data['vendor'] ?? '';
            $type = $data['type'] ?? '';
            $tags = $data['tags'] ?? '';
            $published = strtolower($data['published'] ?? 'true');
            
            // Variant data (Shopify can have multiple variants per product)
            $variantSku = $data['variant sku'] ?? $data['variant_sku'] ?? $data['sku'] ?? '';
            $variantPrice = $data['variant price'] ?? $data['variant_price'] ?? $data['price'] ?? '0';
            $variantCompareAtPrice = $data['variant compare at price'] ?? $data['variant_compare_at_price'] ?? $data['compare at price'] ?? '';
            $variantInventory = $data['variant inventory qty'] ?? $data['variant_inventory_qty'] ?? $data['inventory'] ?? $data['inventory quantity'] ?? '0';
            
            // Image URLs - Shopify uses "Image Src", "Image Src 2", etc.
            $images = [];
            for ($i = 1; $i <= 5; $i++) {
                if ($i === 1) {
                    $imgKey = "image src";
                    $imgAltKey = "image alt text";
                } else {
                    $imgKey = "image src " . $i;
                    $imgAltKey = "image alt text " . $i;
                }
                
                // Also try alternative formats
                if (!isset($data[$imgKey]) || empty($data[$imgKey])) {
                    $imgKey = "image" . ($i > 1 ? $i : "");
                }
                
                if (isset($data[$imgKey]) && !empty(trim($data[$imgKey]))) {
                    $images[] = [
                        'url' => trim($data[$imgKey]),
                        'alt' => isset($data[$imgAltKey]) ? trim($data[$imgAltKey]) : '',
                        'is_primary' => $i === 1,
                        'position' => $i - 1,
                    ];
                }
            }
            
            // Clean price values
            $price = 0;
            if (!empty($variantPrice)) {
                $price = (float) str_replace(['$', ',', ' '], '', $variantPrice);
            }
            
            $compareAtPrice = null;
            if (!empty($variantCompareAtPrice)) {
                $compareAtPrice = (float) str_replace(['$', ',', ' '], '', $variantCompareAtPrice);
            }
            
            // Create product
            $product = [
                'name' => $title,
                'slug' => $productHandle ?: Str::slug($title),
                'sku' => !empty($variantSku) ? $variantSku : null,
                'category_name' => $type ?: ($vendor ?: 'Uncategorized'),
                'short_description' => strip_tags($body),
                'description' => $body,
                'price' => $price,
                'compare_at_price' => $compareAtPrice,
                'stock' => (int) $variantInventory,
                'is_active' => in_array(strtolower($published), ['true', 'yes', '1', 'published']),
                'is_featured' => false,
                'images' => $images,
            ];
            
            $products[] = $product;
        }
        
        fclose($handle);
        
        if (empty($products)) {
            return back()->with('error', 'No products found in Shopify CSV file. Please check the file format.');
        }
        
        return $this->importProducts($products, $importMode);
    }
}

