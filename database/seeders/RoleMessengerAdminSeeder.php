<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Создаёт роль «Админ мессенджера» для раздела управления Nmess.
 * Запуск: php artisan db:seed --class=RoleMessengerAdminSeeder
 */
class RoleMessengerAdminSeeder extends Seeder
{
    public const ROLE_NAME = 'messenger-admin';

    public function run(): void
    {
        Role::firstOrCreate(
            ['name' => self::ROLE_NAME, 'guard_name' => 'web'],
            ['name' => self::ROLE_NAME, 'guard_name' => 'web']
        );
    }
}
