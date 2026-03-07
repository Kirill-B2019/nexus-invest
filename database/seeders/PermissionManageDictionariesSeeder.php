<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Разрешение «Управление справочниками» и роль «Администратор справочников».
 * Доступ к разделу Управление → Общие настройки → Справочники.
 * Запуск: php artisan db:seed --class=PermissionManageDictionariesSeeder
 */
class PermissionManageDictionariesSeeder extends Seeder
{
    public const PERMISSION_NAME = 'manage-dictionaries';
    public const ROLE_NAME = 'dictionaries-admin';

    public function run(): void
    {
        $permission = Permission::firstOrCreate(
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web'],
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web', 'slug' => 'Управление справочниками']
        );

        $role = Role::firstOrCreate(
            ['name' => self::ROLE_NAME, 'guard_name' => 'web'],
            ['name' => self::ROLE_NAME, 'guard_name' => 'web', 'slug' => 'Администратор справочников']
        );

        if (! $role->hasPermissionTo($permission)) {
            $role->givePermissionTo($permission);
        }

        // Роль «Администратор ролей» тоже получает доступ к справочникам
        $rolesAdmin = Role::where('name', 'roles-admin')->where('guard_name', 'web')->first();
        if ($rolesAdmin && ! $rolesAdmin->hasPermissionTo($permission)) {
            $rolesAdmin->givePermissionTo($permission);
        }
    }
}
