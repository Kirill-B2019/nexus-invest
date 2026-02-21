<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;

/**
 * Создаёт роль «Администратор ролей» для управления пользователями, ролями и разрешениями.
 * Запуск: php artisan db:seed --class=RoleRolesAdminSeeder
 * Назначить роль пользователю: User::find(ID)->assignRole('roles-admin');
 */
class RoleRolesAdminSeeder extends Seeder
{
    public const ROLE_NAME = 'roles-admin';

    public function run(): void
    {
        Role::firstOrCreate(
            ['name' => self::ROLE_NAME, 'guard_name' => 'web'],
            ['name' => self::ROLE_NAME, 'guard_name' => 'web']
        );

        $firstUser = User::find(1);
        if ($firstUser && ! $firstUser->hasRole(self::ROLE_NAME)) {
            $firstUser->assignRole(self::ROLE_NAME);
        }
    }
}
