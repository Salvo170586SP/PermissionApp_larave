<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.show', ['user' => $user, 'roles' => $roles, 'permissions' => $permissions]);
    }

    public function destroy(User $user)
    {
        if($user->hasRole('admin')){
            return back()->with('message','sei un admin');
        }

        $user->delete();

        return back()->with('message', 'Utente eliminato');
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            return back()->with('message', ' permission exists');
        }
        $user->givePermissionTo($request->permission);

        return back()->with('message', 'add permission');
    }


    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);

            return back()->with('message', ' permission revoked');
        }

        return back()->with('message', ' permission not exist');
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', ' role exists');
        }

        $user->assignRole($request->role);

        return back()->with('message', 'add role');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);

            return back()->with('message', ' role removed');
        }

        return back()->with('message', ' role not exist');
    }
}
