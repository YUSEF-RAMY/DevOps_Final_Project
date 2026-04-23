<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoutePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $names = [];
        foreach (Route::getRoutes() as $route) {
            $name = $route->getName();
            // Include all admin routes except theme previews and login/logout
            if ($name && 
                str_starts_with($name, 'admin.') && 
                !str_starts_with($name, 'admin.theme') && 
                $name !== 'admin.login' && 
                $name !== 'admin.login.attempt' &&
                $name !== 'admin.logout') {
                $names[] = $name;
            }
        }
        $names = array_values(array_unique($names));

        // Create permissions for all admin routes
        foreach ($names as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'admin']);
        }

        // Sync all permissions to Super Admin role
        $role = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'admin']);
        $allPermissions = Permission::where('guard_name', 'admin')->pluck('name')->toArray();
        $role->syncPermissions($allPermissions);

        $this->command->info('Created ' . count($names) . ' admin route permissions.');
        $this->command->info('Synced ' . count($allPermissions) . ' permissions to Super Admin role.');
    }
}


