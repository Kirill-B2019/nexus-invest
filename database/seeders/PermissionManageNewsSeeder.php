<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

/**
 * Разрешение «Управление редакционными новостями».
 * Запуск: php artisan db:seed --class=PermissionManageNewsSeeder
 */
class PermissionManageNewsSeeder extends Seeder
{
    public const PERMISSION_NAME = 'manage-news';

    public function run(): void
    {
        Permission::firstOrCreate(
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web'],
            ['name' => self::PERMISSION_NAME, 'guard_name' => 'web', 'slug' => 'Управление редакционными новостями']
        );
    }
}
