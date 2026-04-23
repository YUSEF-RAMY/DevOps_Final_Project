<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::orderByDesc('is_default')->orderBy('code')->paginate(15);
        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $currency = Currency::create($data);
        if ($request->boolean('is_default')) {
            Currency::where('id', '!=', $currency->id)->update(['is_default' => false]);
            $currency->is_default = true;
            $currency->save();
        }
        return redirect()->route('admin.currencies.index')->with('success', 'Currency created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        return view('admin.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        $data = $this->validateData($request, $currency->id);
        $currency->update($data);
        if ($request->boolean('is_default')) {
            Currency::where('id', '!=', $currency->id)->update(['is_default' => false]);
            $currency->is_default = true;
            $currency->save();
        }
        return redirect()->route('admin.currencies.index')->with('success', 'Currency updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        if ($currency->is_default) {
            return back()->with('error', 'Cannot delete default currency.');
        }
        $currency->delete();
        return back()->with('success', 'Currency deleted.');
    }

    public function toggle(Currency $currency)
    {
        $currency->is_active = !$currency->is_active;
        $currency->save();
        return back()->with('success', 'Currency status updated.');
    }

    public function setDefault(Currency $currency)
    {
        Currency::query()->update(['is_default' => false]);
        $currency->is_default = true;
        $currency->save();
        return back()->with('success', 'Default currency updated.');
    }

    private function validateData(Request $request, ?int $id = null): array
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'size:3', 'unique:currencies,code,' . ($id ?? 'NULL')],
            'name' => ['required', 'string', 'max:100'],
            'symbol' => ['required', 'string', 'max:10'],
            'is_active' => ['nullable', 'boolean'],
            'is_default' => ['nullable', 'boolean'],
        ]);
        
        // Convert code to uppercase
        $data['code'] = strtoupper($data['code']);
        
        return $data;
    }
}
