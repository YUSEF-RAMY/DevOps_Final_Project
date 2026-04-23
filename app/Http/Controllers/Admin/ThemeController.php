<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ThemeController extends Controller
{
	public function show(string $path = 'index.html')
	{
		$base = resource_path('views/admin/theme');
		$normalized = str_replace(['..', '\\'], ['', '/'], $path);
		if ($normalized === '' || str_ends_with($normalized, '/')) {
			$normalized .= 'index.html';
		}
		$fullPath = $base . DIRECTORY_SEPARATOR . $normalized;
		if (!File::exists($fullPath) || !str_ends_with($fullPath, '.html')) {
			abort(404);
		}
		$html = File::get($fullPath);
		$themeBase = url('admin/theme');
		// Rewrite relative asset links to public/admin-assets assets
		$html = str_replace(['href="./css/', "href='./css/", 'href="../css/', "href='../css/"], 'href="' . asset('admin-assets/css/') . '/', $html);
		$html = str_replace(['src="./js/', "src='./js/", 'src="../js/', "src='../js/"], 'src="' . asset('admin-assets/js/') . '/', $html);
		$html = str_replace(['src="./assets/', "src='./assets/", 'src="../assets/', "src='../assets/"], 'src="' . asset('admin-assets/assets/') . '/', $html);
		// Rewrite internal page links to /admin/theme/*
		$html = str_replace(['href="./', "href='./"], 'href="' . $themeBase . '/', $html);
		return response($html);
	}
}


