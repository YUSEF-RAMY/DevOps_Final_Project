<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as AdminUser;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminController extends Controller
{
    public function index()
    {
        $admins = AdminUser::with('roles')->paginate(20);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->orderBy('name')->get();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:admins,email'],
            'password' => ['nullable','string','min:6'],
            'roles' => ['nullable','array'],
            'roles.*' => ['string'],
        ]);
        $admin = AdminUser::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password'] ?? 'password'),
        ]);
        $roleNames = array_values(array_unique($request->input('roles', [])));
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        $admin->syncRoles($roleNames);
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        return redirect()->route('admin.admins.index')->with('success', 'Administrator created.');
    }

    public function edit(AdminUser $admin)
    {
        $roles = Role::where('guard_name', 'admin')->orderBy('name')->get();
        $assigned = $admin->roles->pluck('name')->toArray();
        return view('admin.admins.edit', compact('admin','roles','assigned'));
    }

    public function update(Request $request, AdminUser $admin)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:admins,email,' . $admin->id],
            'password' => ['nullable','string','min:6'],
            'roles' => ['nullable','array'],
            'roles.*' => ['string'],
        ]);
        $update = [
            'name' => $data['name'],
            'email' => strtolower($data['email']),
        ];
        if (!empty($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }
        $admin->update($update);
        $roleNames = array_values(array_unique($request->input('roles', [])));
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        $admin->syncRoles($roleNames);
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        return redirect()->route('admin.admins.index')->with('success', 'Administrator updated.');
    }

    public function destroy(AdminUser $admin)
    {
        if ($admin->email === 'admin@example.com') {
            return back()->with('error', 'Cannot delete default admin');
        }
        $admin->delete();
        return back()->with('success', 'Administrator deleted.');
    }
}


