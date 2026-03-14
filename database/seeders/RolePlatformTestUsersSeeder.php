<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Тестовые пользователи для платформенных ролей: Инвестор, Инициатор, Эксперт.
 * Запуск: php artisan db:seed --class=RolePlatformTestUsersSeeder
 * Пароль для всех: password
 */
class RolePlatformTestUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'email' => 'investor@test.ru',
                'name' => 'Тест Инвестор',
                'password' => 'password',
                'role' => 'investor',
            ],
            [
                'email' => 'initiator@test.ru',
                'name' => 'Тест Инициатор',
                'password' => 'password',
                'role' => 'initiator',
            ],
            [
                'email' => 'expert@test.ru',
                'name' => 'Тест Эксперт',
                'password' => 'password',
                'role' => 'expert',
            ],
        ];

        foreach ($users as $data) {
            $role = $data['role'];
            unset($data['role']);

            $user = User::withTrashed()->updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => $data['password'],
                    'email_verified_at' => now(),
                ]
            );

            if ($user->trashed()) {
                $user->restore();
            }

            if (! $user->hasRole($role)) {
                $user->assignRole($role);
            }
        }
    }
}
