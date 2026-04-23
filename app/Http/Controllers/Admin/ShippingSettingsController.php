<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingSetting;

class ShippingSettingsController extends Controller
{
    public function index()
    {
        try {
            $settings = ShippingSetting::get();
            // Ensure array fields are initialized
            if (is_null($settings->division_rates)) {
                $settings->division_rates = [];
            }
            if (is_null($settings->district_rates)) {
                $settings->district_rates = [];
            }
            return view('admin.shipping-settings.index', compact('settings'));
        } catch (\Exception $e) {
            \Log::error('Shipping settings index error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading shipping settings: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $data = $request->validate([
                'enabled' => ['sometimes','boolean'],
                'flat_rate' => ['nullable','numeric','min:0'],
                'free_shipping_enabled' => ['sometimes','boolean'],
                'free_shipping_min_total' => ['nullable','numeric','min:0'],
                'division_rates' => ['nullable','array'],
                'district_rates' => ['nullable','array'],
                'tax_enabled' => ['sometimes','boolean'],
                'tax_type' => ['nullable','in:flat,percent'],
                'tax_rate' => ['nullable','numeric','min:0'],
            ]);

            // Normalize division rates: array of {division, type, amount}
            $normalizedDivision = [];
            $divisionRates = (array) $request->input('division_rates', []);
            foreach ($divisionRates as $conf) {
                if (!is_array($conf)) {
                    continue;
                }
                $division = trim((string) ($conf['division'] ?? ''));
                if ($division === '') {
                    continue;
                }
                $type = isset($conf['type']) && in_array($conf['type'], ['flat', 'percent'], true) ? $conf['type'] : 'flat';
                $amount = is_numeric($conf['amount'] ?? null) ? (float) $conf['amount'] : 0.0;
                $normalizedDivision[] = [
                    'division' => $division,
                    'type' => $type,
                    'amount' => $amount,
                ];
            }

            // Normalize district rates: array of {district, type, amount}
            $normalizedDistrict = [];
            $districtRates = (array) $request->input('district_rates', []);
            foreach ($districtRates as $conf) {
                if (!is_array($conf)) {
                    continue;
                }
                $district = trim((string) ($conf['district'] ?? ''));
                if ($district === '') {
                    continue;
                }
                $type = isset($conf['type']) && in_array($conf['type'], ['flat', 'percent'], true) ? $conf['type'] : 'flat';
                $amount = is_numeric($conf['amount'] ?? null) ? (float) $conf['amount'] : 0.0;
                $normalizedDistrict[] = [
                    'district' => $district,
                    'type' => $type,
                    'amount' => $amount,
                ];
            }
        
            $settings = ShippingSetting::get();
            
            // Update settings
            $settings->enabled = $request->boolean('enabled');
            $settings->flat_rate = (float) ($request->input('flat_rate', 0));
            $settings->free_shipping_enabled = $request->boolean('free_shipping_enabled');
            $settings->free_shipping_min_total = (float) ($data['free_shipping_min_total'] ?? 0);
            $settings->division_rates = array_values($normalizedDivision);
            $settings->district_rates = array_values($normalizedDistrict);
            $settings->tax_enabled = $request->boolean('tax_enabled');
            $settings->tax_type = $request->input('tax_type', 'percent');
            $settings->tax_rate = (float) ($request->input('tax_rate', 0));
            
            $settings->save();
            
            return back()->with('success', 'Shipping & tax settings updated.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Shipping settings update error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'An error occurred while updating shipping settings: ' . $e->getMessage())->withInput();
        }
    }
}


