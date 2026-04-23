<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 20);
        if ($perPage < 1) { $perPage = 20; }
        if ($perPage > 100) { $perPage = 100; }
        
        // Filter: parent categories only, subcategories only, or all
        $query = Category::where('is_active', true);
        if ($request->filled('parent_only') && $request->boolean('parent_only')) {
            $query->whereNull('parent_id');
        } elseif ($request->filled('subcategories_only') && $request->boolean('subcategories_only')) {
            $query->whereNotNull('parent_id');
        }
        
        $categories = $query->orderBy('name')->paginate($perPage);
        $data = $categories->getCollection()->map(fn ($c) => $this->categoryResource($c));
        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $categories->currentPage(),
                'last_page' => $categories->lastPage(),
                'per_page' => $categories->perPage(),
                'total' => $categories->total(),
            ],
        ]);
    }

    public function show(string $slug)
    {
        $category = Category::with('parent', 'children')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        return response()->json($this->categoryResource($category, true));
    }

    private function categoryResource(Category $c, bool $detailed = false): array
    {
        $resource = [
            'id' => $c->id,
            'name' => $c->name,
            'slug' => $c->slug,
            'description' => $c->description,
            'is_parent' => $c->parent_id === null,
            'parent' => $c->parent ? [
                'id' => $c->parent->id,
                'name' => $c->parent->name,
                'slug' => $c->parent->slug,
            ] : null,
        ];
        
        if ($detailed && $c->children) {
            $resource['subcategories'] = $c->children->where('is_active', true)->map(fn ($child) => [
                'id' => $child->id,
                'name' => $child->name,
                'slug' => $child->slug,
            ])->values();
        }
        
        return $resource;
    }
}


