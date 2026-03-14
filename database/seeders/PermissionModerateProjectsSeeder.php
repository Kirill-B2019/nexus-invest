<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * |KB 2026-03-13 Разрешение «Модерация проектов» для администраторов.
 * Запуск: php artisan db:seed --class=PermissionModerateProjectsSeeder
 */
class PermissionModerateProjectsSeeder extends Seeder
{
    public const PERMISSION_NAME = 'moderate-projects';

    public function run(): void
    {
        $permission = Permission::firstOrCreate(
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web'],
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web', 'slug' => 'Модерация проектов']
        );

        $superAdmin = Role::where('name', 'super-admin')->where('guard_name', 'web')->first();
        if ($superAdmin && ! $superAdmin->hasPermissionTo($permission)) {
            $superAdmin->givePermissionTo($permission);
        }
    }
}
