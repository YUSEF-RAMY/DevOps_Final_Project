<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Support\SchemaOrgHelper;
use App\Support\ThemeHelper;

class CategoryController extends Controller
{
	public function show(string $slug)
	{
		$category = Category::with('parent')->where('slug', $slug)->firstOrFail();
		$products = Product::where('category_id', $category->id)
			->where('is_active', true)
			->latest()
			->paginate(12);

		// Schema.org
		$schemaHelper = new SchemaOrgHelper();
		$collectionSchema = $schemaHelper->collectionPage($category);
		$breadcrumbs = $schemaHelper->breadcrumbs([
			['name' => 'Home', 'url' => route('home')],
			['name' => $category->name, 'url' => route('categories.show', $category->slug)],
		]);

		return view(ThemeHelper::view('categories.show'), compact('category', 'products', 'collectionSchema', 'breadcrumbs'));
	}
}
