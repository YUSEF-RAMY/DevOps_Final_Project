<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::pluck('name', 'id');
        return view('admin.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        Category::create($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Category created');
    }

    public function edit(Category $category)
    {
        $parents = Category::where('id', '!=', $category->id)->pluck('name', 'id');
        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted');
    }

    public function checkSlug(Request $request)
    {
        $slug = $request->input('slug');
        $categoryId = $request->input('category_id');
        
        if (empty($slug)) {
            return response()->json(['available' => false, 'message' => 'Slug is required']);
        }
        
        $query = Category::where('slug', $slug);
        if ($categoryId) {
            $query->where('id', '!=', $categoryId);
        }
        
        $exists = $query->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'This slug is already taken' : 'Slug is available'
        ]);
    }

    public function getSubcategories(Category $category)
    {
        $subcategories = Category::where('parent_id', $category->id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);
        
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }
}
