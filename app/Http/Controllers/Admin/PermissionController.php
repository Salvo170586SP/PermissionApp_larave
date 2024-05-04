<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return view('admin.permissions.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $new_permission = new Permission();
        $new_permission->name = $request->name;
        $new_permission->save();

        session()->flash('message', 'permission create');

        return redirect()->route('admin.permissions.index');
    }
    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.edit', ['permission' => $permission, 'roles' => $roles]);
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.permissions.index');
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if ($permission->hasRole($request->role)) {
            return back()->with('message', ' role exists');
        }
        $permission->assignRole($request->role);

        return back()->with('message', 'add role');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back();
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);

            return back()->with('message', ' role removed');
        }
        
        return back()->with('message', ' role not exist');
     }
}
