<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Тестовый пользователь с ролью Супер админ.
 * Запуск: php artisan db:seed --class=RoleSuperAdminTestUserSeeder
 * Email: superadmin@test.ru, пароль: password
 */
class RoleSuperAdminTestUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::withTrashed()->updateOrCreate(
            ['email' => 'superadmin@test.ru'],
            [
                'name' => 'Тест Супер Админ',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        if ($user->trashed()) {
            $user->restore();
        }

        if (! $user->hasRole('super-admin')) {
            $user->assignRole('super-admin');
        }
    }
}
