<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Support\StorageHelper;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        // Get only active parent categories (categories without parent_id)
        $parentCategories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'id');
        // Get all active categories for fallback
        $allCategories = Category::where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'id');
        return view('admin.products.create', compact('parentCategories', 'allCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'sku' => 'nullable|string|max:255|unique:products,sku',
            'category_id' => 'nullable|exists:categories,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $product = Product::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            Log::info('Product create: Image upload detected', [
                'product_id' => $product->id,
                'file_count' => is_array($files) ? count($files) : 1,
                'files' => is_array($files) ? array_map(function($f) { 
                    return $f ? [
                        'name' => $f->getClientOriginalName(),
                        'size' => $f->getSize(),
                        'valid' => $f->isValid()
                    ] : null; 
                }, $files) : ($files ? [
                    'name' => $files->getClientOriginalName(),
                    'size' => $files->getSize(),
                    'valid' => $files->isValid()
                ] : null)
            ]);
            
            // Filter out any null or invalid files
            $files = array_filter($files, function($file) {
                return $file && $file->isValid();
            });
            
            if (!empty($files)) {
                $this->uploadImages($product, $files);
            } else {
                Log::warning('Product create: No valid files after filtering', [
                    'product_id' => $product->id
                ]);
            }
        } else {
            Log::info('Product create: No image files in request', [
                'product_id' => $product->id,
                'has_files' => $request->hasFile('images'),
                'all_files' => $request->allFiles()
            ]);
        }

        return redirect()->route('admin.products.edit', $product)->with('success', 'Product created');
    }

    public function edit(Product $product)
    {
        // Get only active parent categories (categories without parent_id)
        $parentCategories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'id');
        // Get all active categories for fallback
        $allCategories = Category::where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'id');
        // Get subcategories if product has a category with parent
        $subcategories = [];
        if ($product->category_id) {
            $selectedCategory = Category::find($product->category_id);
            if ($selectedCategory && $selectedCategory->parent_id) {
                // Product is assigned to a subcategory, get its parent's subcategories
                $subcategories = Category::where('parent_id', $selectedCategory->parent_id)
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->pluck('name', 'id');
            } elseif ($selectedCategory && !$selectedCategory->parent_id) {
                // Product is assigned to a parent category, get its subcategories
                $subcategories = Category::where('parent_id', $selectedCategory->id)
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->pluck('name', 'id');
            }
        }
        return view('admin.products.edit', compact('product', 'parentCategories', 'allCategories', 'subcategories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $product->id,
            'category_id' => 'nullable|exists:categories,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        
        $product->update($validated);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            Log::info('Product update: Image upload detected', [
                'product_id' => $product->id,
                'file_count' => is_array($files) ? count($files) : 1
            ]);
            $this->uploadImages($product, $files);
        }

        return redirect()->route('admin.products.edit', $product)->with('success', 'Product updated');
    }

    private function uploadImages(Product $product, $files)
    {
        Log::info('uploadImages method called', [
            'product_id' => $product->id,
            'files_type' => gettype($files),
            'is_array' => is_array($files),
            'count' => is_array($files) ? count($files) : 1
        ]);
        
        // Ensure files is an array
        if (!is_array($files)) {
            $files = [$files];
        }
        
        // Filter out null/empty files
        $files = array_filter($files, function($file) {
            $isValid = $file && $file instanceof \Illuminate\Http\UploadedFile;
            if (!$isValid) {
                Log::warning('Filtered out invalid file', [
                    'file_type' => gettype($file),
                    'is_uploaded_file' => $file instanceof \Illuminate\Http\UploadedFile
                ]);
            }
            return $isValid;
        });
        
        if (empty($files)) {
            Log::warning('No valid files provided for product image upload', [
                'product_id' => $product->id,
                'original_count' => count($files)
            ]);
            return;
        }
        
        Log::info('Processing files for upload', [
            'product_id' => $product->id,
            'valid_file_count' => count($files)
        ]);
        
        $disk = StorageHelper::getDisk();
        $hasPrimary = $product->images()->where('is_primary', true)->exists();
        $maxPosition = $product->images()->max('position') ?? 0;

        foreach ($files as $index => $file) {
            // Validate file
            if (!$file || !$file->isValid()) {
                Log::warning('Invalid file in product image upload', [
                    'product_id' => $product->id,
                    'index' => $index,
                    'file_exists' => $file ? 'yes' : 'no',
                    'is_valid' => $file && $file->isValid() ? 'yes' : 'no'
                ]);
                continue;
            }

            // Get file path - use getPathname() which works for uploaded files
            $filePath = $file->getPathname();
            if (empty($filePath) || !file_exists($filePath)) {
                // Try getRealPath() as fallback
                $filePath = $file->getRealPath();
                if (empty($filePath) || !file_exists($filePath)) {
                    Log::error('File does not have a valid path', [
                        'product_id' => $product->id,
                        'index' => $index,
                        'pathname' => $file->getPathname(),
                        'real_path' => $file->getRealPath(),
                        'original_name' => $file->getClientOriginalName(),
                        'is_valid' => $file->isValid(),
                        'error' => $file->getError()
                    ]);
                    continue;
                }
            }

            $extension = $file->getClientOriginalExtension();
            if (empty($extension)) {
                $extension = $file->guessExtension() ?? 'jpg';
            }
            
            $filename = uniqid() . '_' . time() . '.' . $extension;
            
            // Validate filename is not empty
            if (empty($filename)) {
                Log::error('Generated filename is empty', [
                    'product_id' => $product->id,
                    'index' => $index,
                    'extension' => $extension
                ]);
                continue;
            }
            
            try {
                // Store file using configured storage driver
                if ($disk === 'public' || $disk === 'local') {
                    // Ensure products directory exists
                    $productsDir = storage_path('app/public/products');
                    if (!File::exists($productsDir)) {
                        File::makeDirectory($productsDir, 0755, true);
                    }
                    
                    // Read file content - use multiple methods to ensure we get it
                    $content = null;
                    $filePath = null;
                    
                    // Method 1: Try getPathname() first (most reliable for uploaded files)
                    $filePath = $file->getPathname();
                    if (!empty($filePath) && file_exists($filePath)) {
                        $content = file_get_contents($filePath);
                    }
                    
                    // Method 2: If that fails, try getRealPath()
                    if (($content === false || empty($content)) && $file->getRealPath()) {
                        $filePath = $file->getRealPath();
                        if (file_exists($filePath)) {
                            $content = file_get_contents($filePath);
                        }
                    }
                    
                    // Method 3: If still fails, try opening the file as a resource
                    if ($content === false || empty($content)) {
                        try {
                            $handle = fopen($file->getPathname(), 'rb');
                            if ($handle) {
                                $content = stream_get_contents($handle);
                                fclose($handle);
                                $filePath = $file->getPathname();
                            }
                        } catch (\Exception $e) {
                            // Ignore
                        }
                    }
                    
                    // Final check
                    if ($content === false || empty($content)) {
                        Log::error('Failed to read file content - all methods failed', [
                            'product_id' => $product->id,
                            'filename' => $filename,
                            'pathname' => $file->getPathname(),
                            'real_path' => $file->getRealPath(),
                            'path' => method_exists($file, 'path') ? $file->path() : 'N/A',
                            'is_valid' => $file->isValid(),
                            'file_size' => $file->getSize(),
                            'mime_type' => $file->getMimeType()
                        ]);
                        continue;
                    }
                    
                    // Use Storage put - most reliable
                    try {
                        $storagePath = 'products/' . $filename;
                        $result = Storage::disk('public')->put($storagePath, $content);
                        
                        if ($result === false || empty($result)) {
                            // Fallback: Direct file write
                            $targetPath = $productsDir . DIRECTORY_SEPARATOR . $filename;
                            if (file_put_contents($targetPath, $content) === false) {
                                throw new \Exception('Both Storage put and direct write failed');
                            }
                            $path = 'products/' . $filename;
                            Log::info('Product image uploaded (direct write fallback)', [
                                'product_id' => $product->id,
                                'filename' => $filename,
                                'path' => $path
                            ]);
                        } else {
                            // Normalize path
                            $path = $result;
                            $path = str_replace('storage/app/public/', '', $path);
                            $path = str_replace('app/public/', '', $path);
                            $path = ltrim($path, '/');
                            
                            Log::info('Product image uploaded successfully', [
                                'product_id' => $product->id,
                                'filename' => $filename,
                                'path' => $path,
                                'result' => $result
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error('Failed to upload image', [
                            'product_id' => $product->id,
                            'filename' => $filename,
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                        continue;
                    }
                } else {
                    // For cloud storage (S3, Cloudflare, etc.), use putFileAs
                    try {
                        $result = Storage::disk($disk)->putFileAs('products', $file, $filename);
                        if (!$result) {
                            // Fallback to put with content
                            $content = file_get_contents($filePath);
                            if ($content === false) {
                                Log::error('Failed to read file content for cloud storage upload', [
                                    'product_id' => $product->id,
                                    'filename' => $filename,
                                    'file_path' => $filePath
                                ]);
                                continue;
                            }
                            $result = Storage::disk($disk)->put('products/' . $filename, $content);
                            if (!$result) {
                                Log::error('Failed to upload file to cloud storage', [
                                    'product_id' => $product->id,
                                    'filename' => $filename,
                                    'disk' => $disk
                                ]);
                                continue;
                            }
                        }
                        // For cloud storage, keep the path as is (it's already relative)
                        $path = $result ? $result : 'products/' . $filename;
                        Log::info('Product image uploaded to cloud storage', [
                            'product_id' => $product->id,
                            'filename' => $filename,
                            'path' => $path,
                            'disk' => $disk
                        ]);
                    } catch (\Exception $cloudException) {
                        Log::error('Cloud storage upload failed', [
                            'product_id' => $product->id,
                            'filename' => $filename,
                            'disk' => $disk,
                            'error' => $cloudException->getMessage()
                        ]);
                        continue;
                    }
                }

                // Validate path is not empty before creating record
                if (empty($path) || !is_string($path)) {
                    Log::error('Empty or invalid path returned from file storage', [
                        'product_id' => $product->id,
                        'filename' => $filename,
                        'disk' => $disk,
                        'path' => $path,
                        'path_type' => gettype($path)
                    ]);
                    continue;
                }

                // Ensure path doesn't start with storage/app/public/ (Laravel adds this automatically)
                $path = str_replace('storage/app/public/', '', $path);
                $path = str_replace('app/public/', '', $path);
                $path = ltrim($path, '/');

                // Create image record
                $isPrimary = !$hasPrimary && $index === 0;
                $imageRecord = ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                    'position' => $maxPosition + $index + 1,
                    'is_primary' => $isPrimary,
                ]);

                Log::info('Product image record created successfully', [
                    'product_id' => $product->id,
                    'image_id' => $imageRecord->id,
                    'path' => $path,
                    'is_primary' => $isPrimary,
                    'position' => $maxPosition + $index + 1,
                    'file_exists' => file_exists(storage_path('app/public/' . $path)) ? 'yes' : 'no'
                ]);

                if ($isPrimary) {
                    $hasPrimary = true;
                }
            } catch (\Exception $e) {
                Log::error('Error uploading product image', [
                    'product_id' => $product->id,
                    'filename' => $filename,
                    'disk' => $disk,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                continue;
            }
        }
    }

    public function deleteImage(ProductImage $image)
    {
        try {
            $disk = StorageHelper::getDisk();
            // Delete file from storage
            if (Storage::disk($disk)->exists($image->path)) {
                Storage::disk($disk)->delete($image->path);
            }
            
            // If this was primary, set another image as primary
            if ($image->is_primary) {
                $nextImage = ProductImage::where('product_id', $image->product_id)
                    ->where('id', '!=', $image->id)
                    ->orderBy('position')
                    ->first();
                if ($nextImage) {
                    $nextImage->update(['is_primary' => true]);
                }
            }
            
            $image->delete();
            
            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting image: ' . $e->getMessage()], 500);
        }
    }

    public function setPrimaryImage(ProductImage $image)
    {
        try {
            // Remove primary from all other images of this product
            ProductImage::where('product_id', $image->product_id)
                ->where('id', '!=', $image->id)
                ->update(['is_primary' => false]);
            
            // Set this image as primary
            $image->update(['is_primary' => true]);
            
            return response()->json(['success' => true, 'message' => 'Primary image updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating primary image: ' . $e->getMessage()], 500);
        }
    }

    public function updateImageOrder(Request $request, Product $product)
    {
        try {
            $request->validate([
                'order' => 'required|array',
                'order.*.id' => 'required|exists:product_images,id',
                'order.*.position' => 'required|integer|min:1',
            ]);

            foreach ($request->input('order') as $item) {
                ProductImage::where('id', $item['id'])
                    ->where('product_id', $product->id)
                    ->update(['position' => $item['position']]);
            }

            return response()->json(['success' => true, 'message' => 'Image order updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating image order: ' . $e->getMessage()], 500);
        }
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted');
    }

    public function lookup(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $query = Product::query()->where('is_active', true);
        if ($q !== '') {
            $query->where(function($qq) use ($q){
                $qq->where('name','like',"%$q%")
                   ->orWhere('sku','like',"%$q%")
                   ->orWhere('id', $q);
            });
        }
        $products = $query->orderBy('name')->take(20)->get(['id','name','sku','price','stock']);
        return response()->json(['data' => $products]);
    }

    public function showJson(Product $product)
    {
        $base = number_format((float) $product->price, 2, '.', '');
        $display = number_format(\App\Support\CurrencyManager::convert((float) $product->price), 2, '.', '');
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'sku' => $product->sku,
            'base_price' => $base,
            'display_price' => $display,
            // keep price for backward compatibility (display currency)
            'price' => $display,
            'stock' => (int) $product->stock,
            'is_active' => (bool) $product->is_active,
        ]);
    }

    public function checkSlug(Request $request)
    {
        $slug = $request->input('slug');
        $productId = $request->input('product_id');
        
        if (empty($slug)) {
            return response()->json(['available' => false, 'message' => 'Slug is required']);
        }
        
        $query = Product::where('slug', $slug);
        if ($productId) {
            $query->where('id', '!=', $productId);
        }
        
        $exists = $query->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'This slug is already taken' : 'Slug is available'
        ]);
    }
}
