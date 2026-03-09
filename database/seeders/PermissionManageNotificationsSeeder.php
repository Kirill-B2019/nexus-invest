<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

/**
 * Разрешение «Управление уведомлениями» — создание и рассылка уведомлений в ЛК.
 * Запуск: php artisan db:seed --class=PermissionManageNotificationsSeeder
 */
class PermissionManageNotificationsSeeder extends Seeder
{
    public const PERMISSION_NAME = 'manage-notifications';

    public function run(): void
    {
        Permission::firstOrCreate(
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web'],
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web', 'slug' => 'Управление уведомлениями']
        );
    }
}
