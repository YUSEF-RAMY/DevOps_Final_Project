<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Support\InstallerHelper;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InstallerController extends Controller
{
    /**
     * Show installer welcome page
     */
    public function index()
    {
        // Allow access to installer even if installed (for re-installation if needed)
        // But show a warning
        $isInstalled = InstallerHelper::isInstalled();

        $requirements = InstallerHelper::checkAllRequirements();
        $allSatisfied = 
            $requirements['php_version']['satisfied'] &&
            $requirements['php_extensions']['satisfied'] &&
            $requirements['folder_permissions']['satisfied'] &&
            $requirements['env_file']['satisfied'];

        return view('frontend.installer.index', [
            'requirements' => $requirements,
            'allSatisfied' => $allSatisfied,
            'isInstalled' => $isInstalled,
        ]);
    }

    /**
     * Show database configuration page
     */
    public function database()
    {
        $dbConfig = session('db_config', [
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => '',
            'username' => 'root',
            'password' => '',
        ]);

        return view('frontend.installer.database', ['dbConfig' => $dbConfig]);
    }

    /**
     * Test database connection
     */
    public function testDatabase(Request $request)
    {
        $request->validate([
            'host' => 'required|string',
            'port' => 'required|integer|min:1|max:65535',
            'database' => 'nullable|string',
            'username' => 'required|string',
            'password' => 'nullable|string',
        ]);

        $config = $request->only(['host', 'port', 'database', 'username', 'password']);
        $result = InstallerHelper::testDatabaseConnection($config);

        return response()->json($result);
    }

    /**
     * Save database configuration
     */
    public function saveDatabase(Request $request)
    {
        $request->validate([
            'host' => 'required|string',
            'port' => 'required|integer|min:1|max:65535',
            'database' => 'required|string',
            'username' => 'required|string',
            'password' => 'nullable|string',
        ]);

        session(['db_config' => $request->only(['host', 'port', 'database', 'username', 'password'])]);

        return response()->json([
            'success' => true,
            'message' => 'Database configuration saved successfully.',
        ]);
    }

    /**
     * Show admin account setup page
     */
    public function admin()
    {
        if (!session('db_config')) {
            return redirect()->route('installer.database');
        }

        $adminData = session('admin_data', [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        return view('frontend.installer.admin', ['adminData' => $adminData]);
    }

    /**
     * Save admin account data and start installation
     */
    public function install(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        session(['admin_data' => $request->only(['name', 'email', 'password'])]);

        return response()->json([
            'success' => true,
            'message' => 'Admin account data saved. Starting installation...',
        ]);
    }

    /**
     * Show installation page
     */
    public function showInstall()
    {
        if (!session('admin_data')) {
            return redirect()->route('installer.admin');
        }

        return view('frontend.installer.install');
    }

    /**
     * Process installation
     */
    public function processInstall(Request $request)
    {
        if (InstallerHelper::isInstalled()) {
            return response()->json([
                'success' => false,
                'message' => 'Application is already installed.',
            ]);
        }

        $dbConfig = session('db_config');
        $adminData = session('admin_data');

        if (!$dbConfig || !$adminData) {
            return response()->json([
                'success' => false,
                'message' => 'Missing configuration data.',
            ]);
        }

        try {
            $steps = [];
            $currentStep = 0;

            // Step 1: Update .env file
            $steps[$currentStep++] = ['name' => 'Updating .env file', 'status' => 'running'];
            $this->updateEnvFile($dbConfig);
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 2: Generate application key
            $steps[$currentStep++] = ['name' => 'Generating application key', 'status' => 'running'];
            Artisan::call('key:generate', ['--force' => true]);
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 3: Clear config cache
            $steps[$currentStep++] = ['name' => 'Clearing configuration cache', 'status' => 'running'];
            Artisan::call('config:clear');
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 4: Create database if not exists
            $steps[$currentStep++] = ['name' => 'Creating database', 'status' => 'running'];
            $this->createDatabaseIfNotExists($dbConfig);
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 5: Run migrations
            $steps[$currentStep++] = ['name' => 'Running database migrations', 'status' => 'running'];
            Artisan::call('migrate', ['--force' => true]);
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 6: Run seeders (with installer admin data)
            $steps[$currentStep++] = ['name' => 'Seeding database', 'status' => 'running'];
            // Temporarily set admin data in config so seeder can use it
            config(['installer.admin_data' => $adminData]);
            Artisan::call('db:seed', ['--force' => true, '--class' => 'DatabaseSeeder']);
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 7: Ensure admin account uses installer credentials
            $steps[$currentStep++] = ['name' => 'Setting up admin account', 'status' => 'running'];
            $admin = Admin::where('email', $adminData['email'])->first();
            if ($admin) {
                $admin->update([
                    'name' => $adminData['name'],
                    'password' => Hash::make($adminData['password']),
                ]);
            } else {
                $admin = $this->createAdminAccount($adminData);
            }
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 8: Run additional seeders
            $steps[$currentStep++] = ['name' => 'Seeding districts and pages', 'status' => 'running'];
            Artisan::call('db:seed', ['--force' => true, '--class' => 'BangladeshDistrictsSeeder']);
            Artisan::call('db:seed', ['--force' => true, '--class' => 'PageSeeder']);
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 9: Assign Super Admin role to admin
            $steps[$currentStep++] = ['name' => 'Setting up permissions', 'status' => 'running'];
            $this->assignSuperAdminRole($admin);
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 10: Create storage link
            $steps[$currentStep++] = ['name' => 'Creating storage link', 'status' => 'running'];
            try {
                Artisan::call('storage:link');
            } catch (\Exception $e) {
                // Storage link might already exist, ignore
            }
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 11: Clear all caches
            $steps[$currentStep++] = ['name' => 'Clearing application cache', 'status' => 'running'];
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 12: Disable installer in database
            $steps[$currentStep++] = ['name' => 'Disabling installer', 'status' => 'running'];
            InstallerHelper::markAsInstalled();
            $steps[$currentStep - 1]['status'] = 'completed';

            // Step 13: Clear all caches
            $steps[$currentStep++] = ['name' => 'Clearing application cache', 'status' => 'running'];
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            $steps[$currentStep - 1]['status'] = 'completed';

            // Clear session data
            session()->forget(['db_config', 'admin_data']);

            return response()->json([
                'success' => true,
                'message' => 'Installation completed successfully!',
                'steps' => $steps,
                'admin_email' => $adminData['email'],
            ]);

        } catch (\Exception $e) {
            \Log::error('Installation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Installation failed: ' . $e->getMessage(),
                'steps' => $steps ?? [],
            ], 500);
        }
    }

    /**
     * Update .env file with database configuration
     */
    private function updateEnvFile(array $dbConfig): void
    {
        $envPath = base_path('.env');
        $envExamplePath = base_path('.env.example');

        // Copy .env.example to .env if .env doesn't exist
        if (!file_exists($envPath) && file_exists($envExamplePath)) {
            copy($envExamplePath, $envPath);
        }

        if (!file_exists($envPath)) {
            throw new \Exception('.env file not found and .env.example is missing.');
        }

        $envContent = file_get_contents($envPath);

        // Update database configuration
        $envContent = preg_replace('/^DB_HOST=.*/m', "DB_HOST={$dbConfig['host']}", $envContent);
        $envContent = preg_replace('/^DB_PORT=.*/m', "DB_PORT={$dbConfig['port']}", $envContent);
        $envContent = preg_replace('/^DB_DATABASE=.*/m', "DB_DATABASE={$dbConfig['database']}", $envContent);
        $envContent = preg_replace('/^DB_USERNAME=.*/m', "DB_USERNAME={$dbConfig['username']}", $envContent);
        $envContent = preg_replace('/^DB_PASSWORD=.*/m', "DB_PASSWORD={$dbConfig['password']}", $envContent);

        // Add if not exists
        if (!preg_match('/^DB_HOST=/m', $envContent)) {
            $envContent .= "\nDB_HOST={$dbConfig['host']}";
        }
        if (!preg_match('/^DB_PORT=/m', $envContent)) {
            $envContent .= "\nDB_PORT={$dbConfig['port']}";
        }
        if (!preg_match('/^DB_DATABASE=/m', $envContent)) {
            $envContent .= "\nDB_DATABASE={$dbConfig['database']}";
        }
        if (!preg_match('/^DB_USERNAME=/m', $envContent)) {
            $envContent .= "\nDB_USERNAME={$dbConfig['username']}";
        }
        if (!preg_match('/^DB_PASSWORD=/m', $envContent)) {
            $envContent .= "\nDB_PASSWORD={$dbConfig['password']}";
        }

        file_put_contents($envPath, $envContent);
    }

    /**
     * Create database if it doesn't exist
     */
    private function createDatabaseIfNotExists(array $dbConfig): void
    {
        try {
            $connection = new \PDO(
                "mysql:host={$dbConfig['host']};port={$dbConfig['port']}",
                $dbConfig['username'],
                $dbConfig['password']
            );
            
            $connection->exec("CREATE DATABASE IF NOT EXISTS `{$dbConfig['database']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        } catch (\PDOException $e) {
            throw new \Exception('Failed to create database: ' . $e->getMessage());
        }
    }

    /**
     * Create admin account
     */
    private function createAdminAccount(array $adminData): Admin
    {
        $admin = Admin::updateOrCreate(
            ['email' => $adminData['email']],
            [
                'name' => $adminData['name'],
                'password' => Hash::make($adminData['password']),
            ]
        );

        return $admin;
    }

    /**
     * Assign Super Admin role to admin
     */
    private function assignSuperAdminRole(Admin $admin): void
    {
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'admin']);
        
        if (!$admin->hasRole('Super Admin')) {
            $admin->assignRole('Super Admin');
        }
    }

    /**
     * Show installation complete page
     */
    public function complete()
    {
        if (!InstallerHelper::isInstalled()) {
            return redirect()->route('installer.index');
        }

        return view('frontend.installer.complete');
    }
}

