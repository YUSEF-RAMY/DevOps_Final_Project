<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Support\InstallerHelper;

class CheckInstallation
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Block installer routes if installer is disabled
        if ($request->is('installer*')) {
            if (!InstallerHelper::isInstallerEnabled()) {
                abort(404, 'Installer has been disabled after successful installation.');
            }
            return $next($request);
        }

        // If not installed, redirect to installer
        if (!InstallerHelper::isInstalled()) {
            return redirect()->route('installer.index');
        }

        return $next($request);
    }
}
