<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

/**
 * Разрешение «Обновление ленты новостей» (источник — канал Дзен).
 * Запуск: php artisan db:seed --class=PermissionUpdateNewsFeedSeeder
 */
class PermissionUpdateNewsFeedSeeder extends Seeder
{
    public const PERMISSION_NAME = 'update-news-feed';

    public function run(): void
    {
        Permission::firstOrCreate(
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web'],
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web', 'slug' => 'Обновление ленты новостей с Дзен']
        );
    }
}
