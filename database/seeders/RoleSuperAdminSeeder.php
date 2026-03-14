<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Роль «Супер админ» — полный доступ ко всем разделам и настройкам.
 * Запуск: php artisan db:seed --class=RoleSuperAdminSeeder
 */
class RoleSuperAdminSeeder extends Seeder
{
    public const ROLE_NAME = 'super-admin';

    public function run(): void
    {
        $role = Role::firstOrCreate(
            ['name' => self::ROLE_NAME, 'guard_name' => 'web'],
            ['name' => self::ROLE_NAME, 'guard_name' => 'web', 'slug' => 'Супер админ']
        );

        $permissions = Permission::where('guard_name', 'web')->get();
        foreach ($permissions as $permission) {
            if (! $role->hasPermissionTo($permission)) {
                $role->givePermissionTo($permission);
            }
        }
    }
}
