<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Support\LicenseHelper;
use App\Models\SiteSetting;

class LicenseController extends Controller
{
    /**
     * Show license activation page
     */
    public function show()
    {
        $licenseInfo = LicenseHelper::getLicenseInfo();
        return view('admin.license.activate', compact('licenseInfo'));
    }

    /**
     * Activate license
     */
    public function activate(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string|min:10',
        ]);

        $result = LicenseHelper::activate($request->license_key);

        if ($result['success']) {
            return redirect()->route('admin.site-settings.index')
                ->with('success', $result['message']);
        }

        return back()->with('error', $result['message'])->withInput();
    }

    /**
     * Check license status (AJAX)
     */
    public function check()
    {
        $isValid = LicenseHelper::isValid();
        $info = LicenseHelper::getLicenseInfo();

        return response()->json([
            'valid' => $isValid,
            'info' => $info,
        ]);
    }

    /**
     * Remove/clear active license
     */
    public function remove(Request $request)
    {
        try {
            $result = LicenseHelper::remove();
            
            if ($result['success']) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => $result['message'],
                    ]);
                }
                
                return redirect()->route('admin.site-settings.index')
                    ->with('success', $result['message']);
            }
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'],
                ], 400);
            }
            
            return back()->with('error', $result['message']);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to remove license: ' . $e->getMessage(),
                ], 500);
            }
            
            return back()->with('error', 'Failed to remove license. Please try again.');
        }
    }
}

