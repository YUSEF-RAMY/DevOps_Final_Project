<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::orderBy('division')->orderBy('sort_order')->orderBy('name')->get();
        $divisions = District::select('division')->distinct()->orderBy('division')->pluck('division');
        
        return view('admin.districts.index', compact('districts', 'divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'division' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        District::create([
            'name' => $request->name,
            'division' => $request->division,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        return redirect()->route('admin.districts.index')
            ->with('success', 'District added successfully.');
    }

    public function update(Request $request, District $district)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'division' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $district->update([
            'name' => $request->name,
            'division' => $request->division,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        return redirect()->route('admin.districts.index')
            ->with('success', 'District updated successfully.');
    }

    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('admin.districts.index')
            ->with('success', 'District deleted successfully.');
    }

    public function toggleStatus(District $district)
    {
        $district->update(['is_active' => !$district->is_active]);
        return redirect()->back()
            ->with('success', 'District status updated.');
    }
}

