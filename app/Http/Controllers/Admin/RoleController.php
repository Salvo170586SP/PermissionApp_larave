<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();

        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('admin.roles.create');
    }
    public function store(Request $request)
    {
        $new_role = new Role();
        $new_role->name = $request->name;
        $new_role->save();

        session()->flash('message', 'Role create');

        return redirect()->route('admin.roles.index');
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    public function update(Request $request, Role $role)
    {
        $role->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.roles.index');
    }
    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message', ' permission exists');
        }
        $role->givePermissionTo($request->permission);

        return back()->with('message', 'add permission');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back();
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);

            return back()->with('message', ' permission revoked');
        }

        return back()->with('message', ' permission not exist');
    }
}
