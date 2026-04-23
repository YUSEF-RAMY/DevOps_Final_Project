<?php

namespace App\Support;

class InstallerHelper
{
    /**
     * Check PHP version
     */
    public static function checkPhpVersion(): array
    {
        $required = '8.2.0';
        $current = PHP_VERSION;
        $satisfied = version_compare($current, $required, '>=');
        
        return [
            'name' => 'PHP Version',
            'required' => $required . '+',
            'current' => $current,
            'satisfied' => $satisfied,
            'message' => $satisfied ? 'PHP version is compatible' : "PHP version must be {$required} or higher",
        ];
    }

    /**
     * Check required PHP extensions
     */
    public static function checkPhpExtensions(): array
    {
        $required = [
            'pdo',
            'pdo_mysql',
            'mbstring',
            'openssl',
            'tokenizer',
            'json',
            'ctype',
            'fileinfo',
            'gd',
            'curl',
        ];
        
        $results = [];
        $allSatisfied = true;
        
        foreach ($required as $extension) {
            $loaded = extension_loaded($extension);
            $results[] = [
                'name' => $extension,
                'satisfied' => $loaded,
                'message' => $loaded ? 'Extension loaded' : "Extension '{$extension}' is not loaded",
            ];
            if (!$loaded) {
                $allSatisfied = false;
            }
        }
        
        return [
            'satisfied' => $allSatisfied,
            'extensions' => $results,
        ];
    }

    /**
     * Check folder permissions
     */
    public static function checkFolderPermissions(): array
    {
        $folders = [
            'storage' => storage_path(),
            'storage/app' => storage_path('app'),
            'storage/framework' => storage_path('framework'),
            'storage/framework/cache' => storage_path('framework/cache'),
            'storage/framework/sessions' => storage_path('framework/sessions'),
            'storage/framework/views' => storage_path('framework/views'),
            'storage/logs' => storage_path('logs'),
            'bootstrap/cache' => base_path('bootstrap/cache'),
        ];
        
        $results = [];
        $allSatisfied = true;
        
        foreach ($folders as $name => $path) {
            $writable = is_writable($path);
            $readable = is_readable($path);
            $satisfied = $writable && $readable;
            
            $results[] = [
                'name' => $name,
                'path' => $path,
                'writable' => $writable,
                'readable' => $readable,
                'satisfied' => $satisfied,
                'message' => $satisfied 
                    ? 'Folder is writable' 
                    : ($writable ? 'Folder is not readable' : 'Folder is not writable'),
            ];
            
            if (!$satisfied) {
                $allSatisfied = false;
            }
        }
        
        return [
            'satisfied' => $allSatisfied,
            'folders' => $results,
        ];
    }

    /**
     * Check if .env file exists
     */
    public static function checkEnvFile(): array
    {
        $envPath = base_path('.env');
        $envExamplePath = base_path('.env.example');
        
        $envExists = file_exists($envPath);
        $envExampleExists = file_exists($envExamplePath);
        
        return [
            'satisfied' => $envExists || $envExampleExists,
            'env_exists' => $envExists,
            'env_example_exists' => $envExampleExists,
            'message' => $envExists 
                ? '.env file exists' 
                : ($envExampleExists ? '.env.example exists (will be copied)' : '.env.example not found'),
        ];
    }

    /**
     * Check if application key is set
     */
    public static function checkAppKey(): array
    {
        $key = config('app.key');
        $satisfied = !empty($key) && $key !== 'base64:';
        
        return [
            'satisfied' => $satisfied,
            'message' => $satisfied ? 'Application key is set' : 'Application key is not set',
        ];
    }

    /**
     * Test database connection
     */
    public static function testDatabaseConnection(array $config): array
    {
        try {
            $connection = new \PDO(
                "mysql:host={$config['host']};port={$config['port']}",
                $config['username'],
                $config['password']
            );
            
            // Check if database exists
            $stmt = $connection->query("SHOW DATABASES LIKE '{$config['database']}'");
            $dbExists = $stmt->rowCount() > 0;
            
            return [
                'satisfied' => true,
                'database_exists' => $dbExists,
                'message' => $dbExists 
                    ? 'Database connection successful and database exists' 
                    : 'Database connection successful but database does not exist (will be created)',
            ];
        } catch (\PDOException $e) {
            return [
                'satisfied' => false,
                'message' => 'Database connection failed: ' . $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Check all requirements
     */
    public static function checkAllRequirements(): array
    {
        return [
            'php_version' => self::checkPhpVersion(),
            'php_extensions' => self::checkPhpExtensions(),
            'folder_permissions' => self::checkFolderPermissions(),
            'env_file' => self::checkEnvFile(),
            'app_key' => self::checkAppKey(),
        ];
    }

    /**
     * Check if installation is complete
     */
    public static function isInstalled(): bool
    {
        try {
            // Check database for installer_enabled setting
            if (\Schema::hasTable('site_settings')) {
                $siteSetting = \App\Models\SiteSetting::first();
                if ($siteSetting && isset($siteSetting->installer_enabled)) {
                    // If installer_enabled is false, installation is complete
                    return !$siteSetting->installer_enabled;
                }
            }
            
            // Fallback to lock file check (for backward compatibility)
            $lockFile = storage_path('app/installed.lock');
            return file_exists($lockFile);
        } catch (\Exception $e) {
            // If database is not available, check lock file
            $lockFile = storage_path('app/installed.lock');
            return file_exists($lockFile);
        }
    }
    
    /**
     * Check if installer is enabled
     */
    public static function isInstallerEnabled(): bool
    {
        try {
            if (\Schema::hasTable('site_settings')) {
                $siteSetting = \App\Models\SiteSetting::first();
                if ($siteSetting && isset($siteSetting->installer_enabled)) {
                    return (bool) $siteSetting->installer_enabled;
                }
            }
            // Default to enabled if setting doesn't exist
            return true;
        } catch (\Exception $e) {
            // Default to enabled if database is not available
            return true;
        }
    }

    /**
     * Mark installation as complete
     */
    public static function markAsInstalled(): void
    {
        try {
            // Update database setting to disable installer
            if (\Schema::hasTable('site_settings')) {
                $siteSetting = \App\Models\SiteSetting::first();
                if ($siteSetting) {
                    $siteSetting->update(['installer_enabled' => false]);
                } else {
                    \App\Models\SiteSetting::create(['installer_enabled' => false]);
                }
            }
        } catch (\Exception $e) {
            \Log::warning('Failed to update installer_enabled in database', ['error' => $e->getMessage()]);
        }
        
        // Also create lock file for backward compatibility
        $lockFile = storage_path('app/installed.lock');
        file_put_contents($lockFile, date('Y-m-d H:i:s'));
    }
    
    /**
     * Enable installer (for re-installation if needed)
     */
    public static function enableInstaller(): void
    {
        try {
            if (\Schema::hasTable('site_settings')) {
                $siteSetting = \App\Models\SiteSetting::first();
                if ($siteSetting) {
                    $siteSetting->update(['installer_enabled' => true]);
                } else {
                    \App\Models\SiteSetting::create(['installer_enabled' => true]);
                }
            }
        } catch (\Exception $e) {
            \Log::warning('Failed to enable installer in database', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Get installation status
     */
    public static function getInstallationStatus(): array
    {
        return [
            'installed' => self::isInstalled(),
            'installer_enabled' => self::isInstallerEnabled(),
            'lock_file' => storage_path('app/installed.lock'),
        ];
    }
}

