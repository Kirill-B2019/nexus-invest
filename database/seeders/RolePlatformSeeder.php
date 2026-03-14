<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Платформенные роли: Инвестор, Инициатор, Эксперт.
 * Каждая роль получает доступ в ЛК (access-lk).
 * Запуск: php artisan db:seed --class=RolePlatformSeeder
 */
class RolePlatformSeeder extends Seeder
{
    public const ROLE_INVESTOR = 'investor';
    public const ROLE_INITIATOR = 'initiator';
    public const ROLE_EXPERT = 'expert';

    public function run(): void
    {
        $accessLk = Permission::where('name', PermissionAccessLkSeeder::PERMISSION_NAME)
            ->where('guard_name', 'web')
            ->first();

        if (! $accessLk) {
            $this->command->warn('Сначала выполните: php artisan db:seed --class=PermissionAccessLkSeeder');
            return;
        }

        $roles = [
            [self::ROLE_INVESTOR, 'Инвестор'],
            [self::ROLE_INITIATOR, 'Инициатор'],
            [self::ROLE_EXPERT, 'Эксперт'],
        ];

        foreach ($roles as [$name, $slug]) {
            $role = Role::firstOrCreate(
                ['name' => $name, 'guard_name' => 'web'],
                ['name' => $name, 'guard_name' => 'web', 'slug' => $slug]
            );
            if (! $role->hasPermissionTo($accessLk)) {
                $role->givePermissionTo($accessLk);
            }
        }
    }
}
