<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Управление пользователями, ролями и разрешениями (доступно роли roles-admin).
 */
class RolesAdminController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('lk.admin.roles.users');
    }

    // --- Пользователи ---

    public function users(): View
    {
        $users = User::query()
            ->with('roles')
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'created_at']);
        $roles = Role::where('guard_name', 'web')->orderBy('name')->get();

        return view('app.pages.roles-admin.users', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function userEdit(User $user): View
    {
        $roles = Role::where('guard_name', 'web')->orderBy('name')->get();
        $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get();

        return view('app.pages.roles-admin.user-edit', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function userUpdate(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'roles' => 'sometimes|array',
            'roles.*' => 'string|exists:roles,name',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $roleNames = $request->input('roles', []);
        $user->syncRoles($roleNames);

        $permissionIds = array_filter(array_map('intval', (array) $request->input('permissions', [])));
        $permissions = $permissionIds ? Permission::whereIn('id', $permissionIds)->get() : collect();
        $user->syncPermissions($permissions);

        return redirect()
            ->route('lk.admin.roles.users')
            ->with('status', __('Роли и разрешения пользователя :name обновлены.', ['name' => $user->name]));
    }

    // --- Роли ---

    public function roles(): View
    {
        $roles = Role::where('guard_name', 'web')
            ->withCount('permissions')
            ->orderBy('name')
            ->get();

        return view('app.pages.roles-admin.roles', ['roles' => $roles]);
    }

    public function roleCreate(): View
    {
        $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get();

        return view('app.pages.roles-admin.role-form', [
            'role' => null,
            'permissions' => $permissions,
        ]);
    }

    public function roleStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'slug' => 'nullable|string|max:500',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web',
            'slug' => $request->input('slug'),
        ]);
        $permissionIds = array_filter(array_map('intval', (array) $request->input('permissions', [])));
        $role->syncPermissions(
            $permissionIds ? Permission::whereIn('id', $permissionIds)->get() : []
        );

        return redirect()
            ->route('lk.admin.roles.roles')
            ->with('status', __('Роль :name создана.', ['name' => $role->name]));
    }

    public function roleEdit(Role $role): View
    {
        $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get();
        $role->load('permissions');

        return view('app.pages.roles-admin.role-form', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function roleUpdate(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'slug' => 'nullable|string|max:500',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);
        $permissionIds = array_filter(array_map('intval', (array) $request->input('permissions', [])));
        $role->syncPermissions(
            $permissionIds ? Permission::whereIn('id', $permissionIds)->get() : []
        );

        return redirect()
            ->route('lk.admin.roles.roles')
            ->with('status', __('Роль :name обновлена.', ['name' => $role->name]));
    }

    public function roleDestroy(Role $role): RedirectResponse
    {
        $name = $role->name;
        $role->delete();

        return redirect()
            ->route('lk.admin.roles.roles')
            ->with('status', __('Роль :name удалена.', ['name' => $name]));
    }

    // --- Разрешения ---

    public function permissions(): View
    {
        $permissions = Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        return view('app.pages.roles-admin.permissions', ['permissions' => $permissions]);
    }

    public function permissionCreate(): View
    {
        return view('app.pages.roles-admin.permission-form', ['permission' => null]);
    }

    public function permissionStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'slug' => 'nullable|string|max:500',
        ]);

        Permission::create([
            'name' => $request->input('name'),
            'guard_name' => 'web',
            'slug' => $request->input('slug'),
        ]);

        return redirect()
            ->route('lk.admin.roles.permissions')
            ->with('status', __('Разрешение :name создано.', ['name' => $request->input('name')]));
    }

    public function permissionEdit(Permission $permission): View
    {
        return view('app.pages.roles-admin.permission-form', ['permission' => $permission]);
    }

    public function permissionUpdate(Request $request, Permission $permission): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'slug' => 'nullable|string|max:500',
        ]);

        $permission->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect()
            ->route('lk.admin.roles.permissions')
            ->with('status', __('Разрешение :name обновлено.', ['name' => $permission->name]));
    }

    public function permissionDestroy(Permission $permission): RedirectResponse
    {
        $name = $permission->name;
        $permission->delete();

        return redirect()
            ->route('lk.admin.roles.permissions')
            ->with('status', __('Разрешение :name удалено.', ['name' => $name]));
    }
}
