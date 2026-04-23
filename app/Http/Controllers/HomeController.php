<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Support\SchemaOrgHelper;
use App\Support\ThemeHelper;

class HomeController extends Controller
{
	public function index()
	{
		$featuredProducts = Product::where('is_active', true)
			->where('is_featured', true)
			->latest()
			->take(8)
			->get();

		$latestProducts = Product::where('is_active', true)
			->latest()
			->take(8)
			->get();

		$categories = Category::where('is_active', true)
			->with('parent')
			->latest()
			->take(12)
			->get();

		$schemaHelper = new SchemaOrgHelper();
		$organizationSchema = $schemaHelper->organization();
		$websiteSchema = $schemaHelper->website();

		return view(ThemeHelper::view('home.index'), compact('featuredProducts', 'latestProducts', 'categories', 'organizationSchema', 'websiteSchema'));
	}
}
