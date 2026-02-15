<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestUsersSeeder extends Seeder
{
    /**
     * Тестовые пользователи для разработки.
     */
    public function run(): void
    {
        $users = [
            ['email' => 'k@test.ru', 'name' => 'K Test', 'password' => 'password'],
            ['email' => 'ceo@view.ru', 'name' => 'CEO View', 'password' => 'password'],
            ['email' => 'adyl@view.ru', 'name' => 'Adyl View', 'password' => 'password'],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => $data['password'],
                ]
            );
        }
    }
}
