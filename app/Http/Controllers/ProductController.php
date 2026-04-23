<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\ProductReview;
use App\Support\SchemaOrgHelper;
use App\Support\ThemeHelper;
use Illuminate\Support\Str;

class ProductController extends Controller
{
	public function index(Request $request)
	{
		$query = Product::query()->with('images', 'category')->where('is_active', true);
		
		// Search functionality
		if ($search = $request->get('q')) {
			$query->where(function ($q) use ($search) {
				$q->where('name', 'like', "%$search%")
					->orWhere('slug', 'like', "%$search%")
					->orWhere('short_description', 'like', "%$search%")
					->orWhere('description', 'like', "%$search%");
			});
		}
		
		// Category filter
		if ($categorySlug = $request->get('category')) {
			$query->whereHas('category', function ($q) use ($categorySlug) {
				$q->where('slug', $categorySlug);
			});
		}
		
		// Featured filter
		if ($request->has('featured') && $request->get('featured') == '1') {
			$query->where('is_featured', true);
		}
		
		// In stock filter
		if ($request->has('in_stock') && $request->get('in_stock') == '1') {
			$query->where('stock', '>', 0);
		}
		
		// Price range filter (robust parsing and min/max swap)
		$minPrice = $request->filled('min_price') ? (float) $request->get('min_price') : null;
		$maxPrice = $request->filled('max_price') ? (float) $request->get('max_price') : null;
		if (!is_null($minPrice) && !is_null($maxPrice) && $minPrice > $maxPrice) {
			[$minPrice, $maxPrice] = [$maxPrice, $minPrice];
		}
		if (!is_null($minPrice)) {
			$query->where('price', '>=', $minPrice);
		}
		if (!is_null($maxPrice)) {
			$query->where('price', '<=', $maxPrice);
		}

		// On sale filter
		if ($request->has('on_sale') && $request->get('on_sale') == '1') {
			$query->whereNotNull('compare_at_price')->whereColumn('price', '<', 'compare_at_price');
		}

		// Has image filter
		if ($request->has('has_image') && $request->get('has_image') == '1') {
			$query->whereHas('images');
		}
		
		// Sorting
		$sort = $request->get('sort', 'newest');
		switch ($sort) {
			case 'name':
				$query->orderBy('name', 'asc');
				break;
			case 'name_desc':
				$query->orderBy('name', 'desc');
				break;
			case 'price_asc':
				$query->orderBy('price', 'asc');
				break;
			case 'price_desc':
				$query->orderBy('price', 'desc');
				break;
			case 'oldest':
				$query->oldest();
				break;
			case 'newest':
			default:
				$query->latest();
				break;
		}
		
		$perPage = (int) $request->get('per_page', 12);
		$perPage = max(6, min(60, $perPage));
		$products = $query->paginate($perPage)->withQueryString();
		$categories = Category::where('is_active', true)->orderBy('name')->get();
		
		return view(ThemeHelper::view('products.index'), compact('products', 'categories'));
	}

	public function show(string $slug)
	{
		$product = Product::with(['images', 'category.parent', 'approvedReviews.user'])->where('slug', $slug)->firstOrFail();
		
		$related = Product::where('category_id', $product->category_id)
			->where('id', '!=', $product->id)
			->latest()
			->take(10)
			->get();
		$settings = SiteSetting::get();
		$userCanReview = false;
		$userHasReviewed = false;
		
		if (auth()->check()) {
			$userCanReview = !$settings->reviews_require_purchase || ProductReview::hasPurchasedProduct(auth()->id(), $product->id);
			$userHasReviewed = ProductReview::where('product_id', $product->id)
				->where('user_id', auth()->id())
				->exists();
		}

		// Schema.org
		$schemaHelper = new SchemaOrgHelper();
		$productSchema = $schemaHelper->product($product);
		$breadcrumbs = $schemaHelper->breadcrumbs([
			['name' => 'Home', 'url' => route('home')],
			['name' => $product->category->name ?? 'Products', 'url' => $product->category ? route('categories.show', $product->category->slug) : route('products.index')],
			['name' => $product->name, 'url' => route('products.show', $product->slug)],
		]);
		
		return view(ThemeHelper::view('products.show'), compact('product', 'related', 'settings', 'userCanReview', 'userHasReviewed', 'productSchema', 'breadcrumbs'));
	}

	public function search(Request $request)
	{
		$query = $request->get('q', '');
		
		if (strlen($query) < 3) {
			return response()->json(['products' => []]);
		}
		
		$products = Product::with(['images', 'category'])
			->where('is_active', true)
			->where(function ($q) use ($query) {
				$q->where('name', 'like', "%{$query}%")
					->orWhere('slug', 'like', "%{$query}%")
					->orWhere('short_description', 'like', "%{$query}%")
					->orWhere('description', 'like', "%{$query}%");
			})
			->limit(20)
			->get()
			->map(function ($product) {
				$primaryImage = $product->images->where('is_primary', true)->first() 
					?? $product->images->first();
				$imageUrl = $primaryImage 
					? asset('storage/' . $primaryImage->path) 
					: asset('admin-assets/assets/img/AdminLTELogo.png');
				
				$isOnSale = $product->compare_at_price && $product->price < $product->compare_at_price;
				$discountPercent = $isOnSale 
					? round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100)
					: 0;
				
				return [
					'id' => $product->id,
					'name' => $product->name,
					'slug' => $product->slug,
					'price' => number_format($product->price, 2),
					'compare_at_price' => $product->compare_at_price ? number_format($product->compare_at_price, 2) : null,
					'image' => $imageUrl,
					'url' => route('products.show', $product->slug),
					'category' => $product->category ? $product->category->name : null,
					'stock' => $product->stock,
					'in_stock' => $product->stock > 0,
					'short_description' => $product->short_description ? Str::limit(strip_tags($product->short_description), 80) : null,
					'is_on_sale' => $isOnSale,
					'discount_percent' => $discountPercent,
				];
			});
		
		return response()->json(['products' => $products]);
	}
}
