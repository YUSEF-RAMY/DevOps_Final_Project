<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route as RouteFacade;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
	public function index()
	{
		$roles = Role::query()->paginate(20);
		return view('admin.roles.index', compact('roles'));
	}

	public function create()
	{
        $routeNames = $this->adminRouteNames();
        return view('admin.roles.create', compact('routeNames'));
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:255|unique:roles,name',
		]);
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'admin']);
        $permissionNames = array_values(array_unique($request->input('permissions', [])));
        foreach ($permissionNames as $permName) {
            Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'admin']);
        }
        // Force detach everything, then reattach to ensure removals are persisted
        $role->permissions()->detach();
        $permissions = Permission::where('guard_name', 'admin')
            ->whereIn('name', $permissionNames)
            ->get();
        $role->syncPermissions($permissions);
        app(PermissionRegistrar::class)->forgetCachedPermissions();
		return redirect()->route('admin.roles.index')->with('success', 'Role created');
	}

	public function edit(Role $role)
	{
        $routeNames = $this->adminRouteNames();
        return view('admin.roles.edit', compact('role', 'routeNames'));
	}

    protected function adminRouteNames(): array
    {
        $names = [];
        foreach (RouteFacade::getRoutes() as $route) {
            $name = $route->getName();
            if ($name && str_starts_with($name, 'admin.') && !str_starts_with($name, 'admin.theme') && !str_starts_with($name, 'admin.login')) {
                $names[] = $name;
            }
        }
        sort($names);
        return $names;
    }

	public function update(Request $request, Role $role)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
		]);
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        $role->update(['name' => $validated['name']]);
        $permissionNames = array_values(array_unique($request->input('permissions', [])));
        foreach ($permissionNames as $permName) {
            Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'admin']);
        }
        $role->permissions()->detach();
        $permissions = Permission::where('guard_name', 'admin')
            ->whereIn('name', $permissionNames)
            ->get();
        $role->syncPermissions($permissions);
        app(PermissionRegistrar::class)->forgetCachedPermissions();
		return redirect()->route('admin.roles.index')->with('success', 'Role updated');
	}

	public function destroy(Role $role)
	{
		$role->delete();
		return redirect()->route('admin.roles.index')->with('success', 'Role deleted');
	}

	public function copy(Role $role)
	{
		$routeNames = $this->adminRouteNames();
		$assigned = $role->permissions->pluck('name')->toArray();
		return view('admin.roles.copy', compact('role', 'assigned', 'routeNames'));
	}

	public function storeCopy(Request $request, Role $role)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:255|unique:roles,name',
		]);
		app(PermissionRegistrar::class)->forgetCachedPermissions();
		$newRole = Role::create(['name' => $validated['name'], 'guard_name' => 'admin']);
		$permissionNames = array_values(array_unique($request->input('permissions', [])));
		foreach ($permissionNames as $permName) {
			Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'admin']);
		}
		$newRole->permissions()->detach();
		$permissions = Permission::where('guard_name', 'admin')
			->whereIn('name', $permissionNames)
			->get();
		$newRole->syncPermissions($permissions);
		app(PermissionRegistrar::class)->forgetCachedPermissions();
		return redirect()->route('admin.roles.index')->with('success', 'Role copied successfully');
	}
}


