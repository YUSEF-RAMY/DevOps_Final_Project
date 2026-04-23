<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Support\LicenseHelper;

class CheckLicense
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip license check for installer, license activation, and health check routes
        if ($request->is('installer*') || 
            $request->is('admin/license*') || 
            $request->is('up') ||
            $request->is('storage/*')) {
            return $next($request);
        }

        // Check if license key exists in database
        $licenseKey = LicenseHelper::getLicenseKey();
        
        // If no license key is set, block all access (except installer)
        if (empty($licenseKey)) {
            // For admin routes, redirect to license activation
            if ($request->is('admin*')) {
                return redirect()->route('admin.license.activate')
                    ->with('error', 'Please activate your license key to access the application.');
            }
            
            // For frontend and all other routes, show license required page
            return response()->view('frontend.errors.license-required', [], 403);
        }

        // If license key exists, validate it
        if (!LicenseHelper::isValid()) {
            // Redirect to license activation page
            if ($request->is('admin*')) {
                return redirect()->route('admin.license.activate')
                    ->with('error', 'Your license key is invalid or expired. Please activate a valid license.');
            }
            
            // For frontend, show license invalid page
            return response()->view('frontend.errors.license-invalid', [], 403);
        }

        return $next($request);
    }
}

