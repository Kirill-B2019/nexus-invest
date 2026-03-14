<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Разрешение «Вход в личный кабинет» и роль «Пользователь кабинета» с этим разрешением.
 * Запуск: php artisan db:seed --class=PermissionAccessLkSeeder
 * Назначить роль пользователю: User::find(ID)->assignRole('cabinet-user');
 */
class PermissionAccessLkSeeder extends Seeder
{
    public const PERMISSION_NAME = 'access-lk';
    public const ROLE_NAME = 'cabinet-user';

    public function run(): void
    {
        $permission = Permission::firstOrCreate(
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web'],
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web', 'slug' => 'Вход в личный кабинет']
        );

        $role = Role::firstOrCreate(
            ['name' => self::ROLE_NAME, 'guard_name' => 'web'],
            ['name' => self::ROLE_NAME, 'guard_name' => 'web', 'slug' => 'Пользователь личного кабинета']
        );

        if (! $role->hasPermissionTo($permission)) {
            $role->givePermissionTo($permission);
        }

        // Админ-роли и супер-админ тоже должны заходить в кабинет
        foreach (['super-admin', 'roles-admin', 'messenger-admin'] as $adminRoleName) {
            $adminRole = Role::where('name', $adminRoleName)->where('guard_name', 'web')->first();
            if ($adminRole && ! $adminRole->hasPermissionTo($permission)) {
                $adminRole->givePermissionTo($permission);
            }
        }
    }
}
