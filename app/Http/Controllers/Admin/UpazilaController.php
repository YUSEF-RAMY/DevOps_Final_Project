<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Upazila;
use App\Models\District;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'district_id' => ['required', 'exists:districts,id'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        Upazila::create([
            'name' => $request->name,
            'district_id' => $request->district_id,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        return redirect()->route('admin.districts.index')
            ->with('success', 'Upazila added successfully.');
    }

    public function update(Request $request, Upazila $upazila)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'district_id' => ['required', 'exists:districts,id'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $upazila->update([
            'name' => $request->name,
            'district_id' => $request->district_id,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        return redirect()->route('admin.districts.index')
            ->with('success', 'Upazila updated successfully.');
    }

    public function destroy(Upazila $upazila)
    {
        $upazila->delete();
        return redirect()->route('admin.districts.index')
            ->with('success', 'Upazila deleted successfully.');
    }

    public function toggleStatus(Upazila $upazila)
    {
        $upazila->update(['is_active' => !$upazila->is_active]);
        return redirect()->back()
            ->with('success', 'Upazila status updated.');
    }

    public function getByDistrict(Request $request)
    {
        $districtId = $request->input('district_id');
        $upazilas = Upazila::where('district_id', $districtId)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name']);
        
        return response()->json($upazilas);
    }
}

