<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function clear_cache()
    {
      $results = [];
      $successCount = 0;
      $errorCount = 0;
  
      // Test database connection first
      $dbConnected = false;
      try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        $dbConnected = true;
        $results[] = '✓ Database connection: OK';
        $successCount++;
      } catch (\Exception $e) {
        $dbConnected = false;
        $dbError = $e->getMessage();
        $results[] = '✗ Database connection: FAILED';
        $results[] = '  Error: ' . $dbError;
        $results[] = '⚠ Note: Session driver is set to "database" - this may cause issues';
        $results[] = '💡 Tip: If DB is unavailable, temporarily set SESSION_DRIVER=file in .env';
        $errorCount++;
      }
  
      // Fix storage permissions (Docker-specific)
      try {
        $storagePath = storage_path();
        if (is_dir($storagePath)) {
          // Try to fix permissions
          if (function_exists('chmod')) {
            @chmod($storagePath . '/logs', 0775);
            @chmod($storagePath . '/framework', 0775);
            @chmod($storagePath . '/framework/cache', 0775);
            @chmod($storagePath . '/framework/sessions', 0775);
            @chmod($storagePath . '/framework/views', 0775);
          }
          $results[] = '✓ Storage permissions checked';
          $successCount++;
        }
      } catch (\Exception $e) {
        $results[] = '⚠ Storage permissions: ' . $e->getMessage();
      }
  
      // Clear caches that don't require database connection
      // Temporarily switch to array session driver if DB is unavailable to prevent session errors
      $originalSessionDriver = config('session.driver');
      if (!$dbConnected && $originalSessionDriver === 'database') {
        config(['session.driver' => 'array']);
        $results[] = '⚠ Temporarily switched session driver to "array" (DB unavailable)';
      }
  
      try {
        Artisan::call('cache:clear');
        $results[] = '✓ Cache cleared';
        $successCount++;
      } catch (\Exception $e) {
        $results[] = '✗ Cache clear failed: ' . $e->getMessage();
        $errorCount++;
      }
  
      try {
        Artisan::call('config:clear');
        $results[] = '✓ Config cleared';
        $successCount++;
      } catch (\Exception $e) {
        $results[] = '✗ Config clear failed: ' . $e->getMessage();
        $errorCount++;
      }
  
      try {
        Artisan::call('view:clear');
        $results[] = '✓ View cache cleared';
        $successCount++;
      } catch (\Exception $e) {
        $results[] = '✗ View clear failed: ' . $e->getMessage();
        $errorCount++;
      }
  
      try {
        Artisan::call('route:clear');
        $results[] = '✓ Route cache cleared';
        $successCount++;
      } catch (\Exception $e) {
        $results[] = '✗ Route clear failed: ' . $e->getMessage();
        $errorCount++;
      }
  
      try {
        Artisan::call('optimize:clear');
        $results[] = '✓ Optimize cleared';
        $successCount++;
      } catch (\Exception $e) {
        $results[] = '✗ Optimize clear failed: ' . $e->getMessage();
        $errorCount++;
      }
  
      // Only run these if database is available (they require DB connection)
      if ($dbConnected) {
        // NOTE: We do NOT run config:cache or route:cache here because running them 
        // via a web request can cause environment variable issues (env() returns null)
        // resulting in failed database connections (Connection Refused) if the 
        // cached config falls back to defaults (127.0.0.1) instead of Docker names.
        // We only want to CLEAR caches, not generate new immutable ones.
  
        $results[] = '✓ config:cache skipped (prevents Docker environment issues)';
        $results[] = '✓ route:cache skipped (prevents Docker environment issues)';
  
        /*
        try {
          Artisan::call('config:cache');
          $results[] = '✓ Config cached';
          $successCount++;
        } catch (\Exception $e) {
          $results[] = '✗ Config cache failed: ' . $e->getMessage();
          $errorCount++;
        }
  
        try {
          Artisan::call('route:cache');
          $results[] = '✓ Route cached';
          $successCount++;
        } catch (\Exception $e) {
          $results[] = '✗ Route cache failed: ' . $e->getMessage();
          $errorCount++;
        }
  
        try {
          Artisan::call('optimize');
          $results[] = '✓ Application optimized';
          $successCount++;
        } catch (\Exception $e) {
          $results[] = '✗ Optimize failed: ' . $e->getMessage();
          $errorCount++;
        }
        */
      } else {
        // Database connection failed - skip commands that require DB
        $results[] = '⚠ Skipped optimization commands (database unavailable)';
        $results[] = '💡 To fix database connection:';
        $results[] = '   1. Check MySQL container: docker ps | grep mysql';
        $results[] = '   2. Verify .env DB_HOST, DB_PORT, DB_DATABASE settings';
        $results[] = '   3. In Docker, DB_HOST should be container name (e.g., otithee_mysql)';
        $results[] = '   4. Or temporarily set SESSION_DRIVER=file in .env to avoid session errors';
      }
  
      // Restore original session driver
      if (!$dbConnected && isset($originalSessionDriver)) {
        config(['session.driver' => $originalSessionDriver]);
      }
  
      $message = implode("\n", $results);
  
      // Return JSON if it's an AJAX request, otherwise return plain text
      if (request()->ajax() || request()->wantsJson()) {
        return response()->json([
          'success' => $errorCount === 0,
          'message' => $message,
          'results' => $results,
          'summary' => [
            'success' => $successCount,
            'errors' => $errorCount
          ]
        ]);
      }
  
      return $message;
    }
  
}
