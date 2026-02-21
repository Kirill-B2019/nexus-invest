<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

/**
 * Создаёт разрешение «Доступ к мессенджеру» (TrueConf).
 * Запуск: php artisan db:seed --class=PermissionUseMessengerSeeder
 */
class PermissionUseMessengerSeeder extends Seeder
{
    public const PERMISSION_NAME = 'use-messenger';

    public function run(): void
    {
        Permission::firstOrCreate(
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web'],
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web']
        );
    }
}
